<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Quiz.php';

class QuizRepository extends Repository
{

    public function getQuiz(int $id): ?Quiz
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM quiz WHERE id = :email
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($quiz == false) {
            return null;
        }

        return new Quiz(
            $quiz['title'],
            $quiz['description'],
            $quiz['image']


        );
    }
    public function addQuiz(Quiz $quiz): void
    {
        session_start();

        $date= new DateTime();
        $stmt = $this->database->connect()->prepare("
            INSERT INTO quizzes (title, description, created_at, id_assigned_by, image)
            VALUES (?,?,?,?,?)
        ");

        $userId = $_SESSION['user_id'];

        $stmt->execute([
            $quiz->getTitle(),
            $quiz->getDescription(),
            $date->format('Y-m-d'),
            $userId,
            $quiz->getImage()

        ]);
    }

    public function getQuizzes(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM quizzes
        ');

        $stmt->execute();
        $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($quizzes as $quiz)
        {
            $result[] = new Quiz(
                $quiz['title'],
                $quiz['description'],
                $quiz['image']


            );

        }

        return $result;
    }

    public function getCurrentUserQuizzes(): array
    {
        session_start();

        $userId = $_SESSION['user_id'];

        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM quizzes WHERE id_assigned_by = :userId
        ');

        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($quizzes as $quiz)
        {
            $result[] = new Quiz(
                $quiz['title'],
                $quiz['description'],
                $quiz['image']


            );

        }

        return $result;
    }
    public function getQuizByTitle(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM quizzes WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//    public function getQuestions(): array
//    {
//        $result = [];
//        $stmt = $this->database->connect()->prepare('
//            SELECT * FROM questions
//        ');
//
//        $stmt->execute();
//        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        foreach($questions as $question)
//        {
//            $result[] = new Question(
//                $question['question'],
//                $question['answera'],
//                $question['answerb'],
//                $question['answerc'],
//                $question['answerd'],
//                $question['answercorrect']
//
//
//            );
//
//        }
//
//        return $result;
//    }

}