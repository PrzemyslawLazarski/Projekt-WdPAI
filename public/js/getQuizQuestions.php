<?php
// getQuizQuestions.php

include_once __DIR__ .'/../../src/repository/QuizRepository.php';  // Załaduj klasę QuizRepository

$quizId = $_GET['quizId'] ?? null;

if (!$quizId) {
    echo json_encode(['error' => 'No quiz ID provided']);
    exit;
}
echo ("Siema");
$repository = new QuizRepository();  // Załóż, że masz taki obiekt
$questions = $repository->getQuestionsForQuiz($quizId);

echo json_encode($questions);