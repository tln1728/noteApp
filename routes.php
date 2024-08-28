<?php

$router -> get    ('/'               , 'index.php');
$router -> get    ('/about'          , 'about.php');
$router -> get    ('/contact'        , 'contact.php');

$router -> get    ('/notes'          , 'notes/index.php');
$router -> get    ('/note'           , 'notes/show.php');
$router -> delete ('/note'           , 'notes/destroy.php');
$router -> get    ('/notes/create'   , 'notes/create.php')         -> only ('auth');
$router -> post   ('/notes'          , 'notes/store.php');
$router -> get    ('/note/edit'      , 'notes/edit.php');
$router -> patch  ('/note'           , 'notes/update.php');

$router -> get    ('/register'       , 'registration/create.php')  -> only('guest');
$router -> post   ('/register'       , 'registration/store.php')   -> only('guest');

$router -> get    ('/login'          , 'sessions/create.php')      -> only('guest');
$router -> post   ('/session'        , 'sessions/store.php')       -> only('guest');
$router -> delete ('/session'        , 'sessions/destroy.php')     -> only('auth');

// pd($router);
// pd($_SESSION);
// pd($_COOKIE);