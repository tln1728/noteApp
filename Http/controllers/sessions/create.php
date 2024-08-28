<?php

use Core\Session;

view('sessions/create.view.php', [
    'flag' => false,
    'errors' => Session::get('errors') ?? [],
]);