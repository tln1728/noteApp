<?php

use Core\App;
use Core\Validator;
use Core\Database;
use Http\Forms\Loginform;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new Loginform();

if (!$form->validate($email, $password)) {

    return view("sessions/create.view.php", [
        'errors' => $form -> errors(),
        'flag' => true,
    ]);

};

// validate match email
$user = $db->query('select * from users where email = :email', [
    'email' => $email,
])->find();

if (!$user) {
    return view("sessions/create.view.php", [
        'errors' => [
            'email' => 'No matching account found for this email address',
        ],

        'flag' => true,
    ]);
}

// check match password
if (password_verify($password, $user['password'])) {
    login([
        'email' => $email,
    ]);

    header('location: /');
    exit;
    
} else {

    return view("sessions/create.view.php", [
        'errors' => [
            'password' => 'No matching password',
        ],

        'flag' => false,
    ]);
}
