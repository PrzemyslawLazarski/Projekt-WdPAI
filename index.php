<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('main', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('aboutus', 'DefaultController');
Routing::get('features', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('howitworks', 'DefaultController');
Routing::get('quiz', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::get('profile', 'DefaultController');
Routing::get('quizzes', 'QuizController');
Routing::get('discover', 'QuizController');

Routing::post('login', 'SecurityController');
Routing::post('addQuiz', 'QuizController');
Routing::post('search', 'QuizController');
Routing::post('addUser', 'UserController');
Routing::get('logout', 'SecurityController');
Routing::get('getQuizQuestions', 'QuizController');

Routing::run($path);