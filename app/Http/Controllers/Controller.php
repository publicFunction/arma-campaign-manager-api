<?php

namespace ARMACMan\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $auth_payload = ['email', 'password'];

    protected function validateAuth($payload) {
        $valid = true;
        foreach ($this->auth_payload as $field) {
            if(!array_key_exists($field, $payload)) {
                $valid = false;
            }
        }
        return $valid;
    }

}

