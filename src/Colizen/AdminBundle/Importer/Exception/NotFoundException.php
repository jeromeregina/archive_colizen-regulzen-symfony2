<?php

namespace Colizen\AdminBundle\Importer\Exception;

class NotFoundException extends \RuntimeException {
    public function __construct($message, $code=404, $previous) {
        parent::__construct($message, $code, $previous);
    }
}
