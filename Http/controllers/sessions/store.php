<?php

use Core\Authenticator;
use Http\Forms\Loginform;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new Loginform();

if ($form->validate($email, $password)) {

    $auth = new Authenticator;
    
    if (!$auth -> email($email)) {
        
        $form -> error('email', 'No matching account found for this email address');

        return view("sessions/create.view.php", [
            'errors' => $form -> errors(),
            'flag' => false,
        ]);
    }
    
    // login success
    if ($auth -> attempt($email, $password)) redirect('/');
    
    $form -> error('password', 'No matching password');
};

return view("sessions/create.view.php", [
    'errors' => $form -> errors(),
    'flag' => true,
]);