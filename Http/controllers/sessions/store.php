<?php

use Core\Authenticator;
use Http\Forms\Loginform;

$form = LoginForm::validate($attributes = [
    'email'     => $_POST['email'],
    'password'  => $_POST['password']
]);

$signIn = (new Authenticator) -> attempt (
    $attributes['email'], $attributes['password']
);
    
if (!$signIn) {
    $form -> error (
        'email', 'No matching account found for that email address and password.'
    ) -> throw();
}

return redirect('/login');