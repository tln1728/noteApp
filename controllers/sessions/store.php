<?php 

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate null
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a password';
}

if (!empty($errors)) {
    return view("sessions/create.view.php", [
        'errors' => $errors,
        'flag' => true,
    ]);
}

// validate match email
$user = $db -> query('select * from users where email = :email', [
    'email' => $email,
]) -> find();

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