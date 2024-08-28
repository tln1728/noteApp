<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\Loginform;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new Loginform();

if ($form->validate($email, $password)) {

    $auth = new Authenticator;
    
    if (!$auth -> match_email($email)) {
        
        $form -> error('email', 'No matching account found for this email address');
        
        Session::flash('errors', $form -> errors());
        Session::flash('old', [
            'email' => $_POST['email']
        ]);

        return redirect('/login');
    }
    
    // login success
    if ($auth -> attempt($email, $password)) redirect('/');
    
    $form -> error('password', 'No matching password');
};

Session::flash('errors', $form -> errors());
Session::flash('old', [
    'email' => $_POST['email']
]);

return redirect('/login');