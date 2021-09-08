<?php
namespace Daw\Nicepay\Service;

class NpMode {
    const Development = 0;
    const Staging     = 1;
    const Production  = 2;
    const Www         = 3;

    private $currentMode = self::Production;

    /**
     * @return int
     */
    public function getCurrentMode(): int {
        return $this->currentMode;
    }

    /**
     * Get current Mode String
     * @return string
     */
    public function getCurrentModeString(): string {
        switch ($this->currentMode) {
            case self::Development :
                return 'Development';
            case self::Staging :
                return 'Staging';
            case self::Production :
                return 'Production';
            case self::Www :
                return 'Prod';
            default:
                return '-';
        }
    }

}
