<?php

namespace Http\Forms;

use Core\Validator;

class Loginform
{
    protected $errors = [];
    public function validate($email, $password)
    {
        // validate null
        if (!Validator::email($email)) {
            $this -> errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($password)) {
            $this -> errors['password'] = 'Please provide a password';
        }

        return empty($this -> errors);
    }
    public function validate_register($email, $password)
    {
        // validate null
        if (!Validator::email($email)) {
            $this -> errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($password, 6, 32)) {
            $this -> errors['password'] = 'Password must be at least 6 characters and < 32';
        }

        return empty($this -> errors);
    }

    public function errors() {
        return $this -> errors;
    }

    public function error($field, $message) {
        return $this -> errors[$field] = $message;
    }
}
