<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$ck_mail = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

// validate
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if ($ck_mail) {
    $errors['email'] = 'This email is already in use';
}

if (!Validator::string($password, 3, 255)) {
    $errors['password'] = 'Please provide a password of at least 3 characters.';
}

if (!empty($errors)) {
    return view("registration/create.view.php", [
        'errors' => $errors,
        'flag' => true,
    ]);
}

// register
$db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
]);

login([
    'email' => $email,
]);

redirect('/');
