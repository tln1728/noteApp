<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
 
$currentUserId = 7;

// data for note page
$note = $db -> query('select * from notes where id = :id', [
    'id' => $_GET['id'],
]) ->findOrFail();

// authorization
authorize($note['user_id'] === $currentUserId); 

view('notes/show.view.php',[
    'heading' => 'Note',
    'note' => $note,
]);