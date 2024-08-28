<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Http\Forms\Loginform;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new Loginform();

if ($form->validate_register($email, $password)) {

    $auth = new Authenticator;

    if ($auth -> match_email($email)) {
        $form->error('email', 'This email is already in use');

        Session::flash('errors', $form->errors());
        Session::flash('old', [
            'email' => $_POST['email']
        ]);

        return redirect('/register');

    } else {
        // success register
        App::resolve(Database::class) -> query('INSERT INTO users(email, password) VALUES(:email, :password)', [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
        $auth -> login(['email' => $email]);
        return redirect('/');
    }
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $_POST['email']
]);

return redirect('/register');