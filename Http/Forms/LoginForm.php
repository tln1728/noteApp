<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes) 
    {
        // validate null
        if (!Validator::email($attributes['email'])) {
            $this -> errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {
            $this -> errors['password'] = 'Please provide a password';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance -> failed() ? $instance -> throw() : $instance;
        // or return true, its depend
    }

    public function failed() 
    {
        return count($this -> errors);
    }

    public function throw() 
    {
        ValidationException::throw($this ->errors(), $this -> attributes);            
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

        $this -> errors[$field] = $message;

        return $this;
        
    }
}
