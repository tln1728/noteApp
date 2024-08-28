<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 7;

$id = $_POST['id'];

$note = $db -> query('select * from notes where id = :id', [
    'id' => $id,
]) ->findOrFail();

authorize($note['user_id'] === $currentUserId); 

// validate
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (!empty($errors)) {
    return view('notes/edit.view.php',[
        'heading' => 'Edit note ' . $note['body'],
        'note' => $note,
        'errors' => $errors,
    ]); 
}

$db->query('update notes set body = :body where id = :id', [
    'id' => $id,
    'body' => $_POST['body']
]);

header('location: /note?id='.$id);
die();