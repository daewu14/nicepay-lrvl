<?php
namespace Daw\Nicepay\Service;

use Daw\Nicepay\Utils\NpResponse;
use Daw\Nicepay\Utils\NpResponseCode;
use Daw\Nicepay\Utils\RestMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;

abstract class NpService extends NpEndPoint {

    var $METHOD;
    protected $payload;
    protected $fixUrl;
    protected $isPayloadCanBeNull = false;

    /**
     * Main call Nicepay API
     *
     * all functions boil down to this function
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function call() {
        $client = new Client();

        if ($this->METHOD == null)
            return NpResponse::failed('Method Salah', null);

        if ($this->payload == null && !$this->isPayloadCanBeNull)
            return NpResponse::failed('Payload bermasalah', null);

        if ($this->fixUrl == null)
            return NpResponse::failed('End point salah', null);

        $header = [
            'Content-Type' => 'application/json'
        ];

        $params = [
            'headers' => $header,
            'query'   => $this->payload
        ];

        switch ($this->METHOD) {
            case RestMethod::POST :
                $params = [
                    'headers' => $header,
                    'json'    => $this->payload
                ];
                break;
            case RestMethod::GET :
                $params = [
                    'headers' => $header,
                    'query'   => $this->payload
                ];
                break;
            case RestMethod::REDIRECT :
//                return NpResponse::failed("Testing", [
//                    'end_point' => $this->fixUrl,
//                    'payload'   => $this->payload,
//                ]);
                Log::info("NICEPAY-LOG-REDIRECT ==> ", [
                    'end_point' => $this->fixUrl,
                    'payload'   => $this->payload,
                ]);
                return redirect($this->fixUrl);
        }

        try {
            $attemp = $client->request($this->METHOD, $this->fixUrl, $params);

            $contents = json_decode($attemp->getBody()->getContents(), true);

            $result = [
                'method'    => $this->METHOD,
                'end_point' => $this->fixUrl,
                'payload'   => $this->payload,
                'result'    => $contents
            ];

            Log::info("NICEPAY-LOG ==> ", $result);

            if ($contents == null)
                return NpResponse::failed("Respon nicepay tidak ditemukan 0", $result);

            // Jika object respon code isset == false
            if (!isset($contents['resultCd']))
                return NpResponse::failed("Terjadi perubahan respon Nicepay 1", $result);

            // Jika object respon code tidak ada
            if ($contents['resultCd'] == null)
                return NpResponse::failed("Terjadi perubahan respon Nicepay 2", $result);

            // Jika respon code tidak 0000
            if ($contents['resultCd'] != NpResponseCode::Success)
                return NpResponse::failed($contents['resultMsg'], $result);

            return NpResponse::success("Berhasil", $contents);
        } catch (ServerException | RequestException | ConnectException | ClientException $e) {
            $result = [
                'end_point' => $this->fixUrl,
                'payload'   => $this->payload,
                'method'    => $this->METHOD,
                'error'     => [
                    'message'  => $e->getMessage(),
                    'response' => $e->getResponse(),
                ]
            ];
            Log::error('NICEPAY-EXCEPTION-LOG ==> ', $result);
            return NpResponse::failed("Terjadi kesalahan saat menghubungi nicepay", $result);
        }

    }

}
