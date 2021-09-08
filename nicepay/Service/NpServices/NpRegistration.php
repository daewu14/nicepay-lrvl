<?php
namespace packages\daw\nicepay\Service\NpServices;

class NpRegistration extends NpService {

    // registration product
    public function __construct(NpRegistrationRequest $npRegistration) {
        $this->METHOD  = RestMethod::POST;
        $this->payload = $npRegistration->data;
        $this->fixUrl  = $this->registrationUrl();
    }

}
