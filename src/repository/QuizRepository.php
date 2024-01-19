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
        $date= new DateTime();
        $stmt = $this->database->connect()->prepare("
            INSERT INTO quizzes (title, description, created_at, id_assigned_by, image)
            VALUES (?,?,?,?,?)
        ");

        $assignedById = 1;//TODO pobrać z sesji

        $stmt->execute([
            $quiz->getTitle(),
            $quiz->getDescription(),
            $date->format('Y-m-d'),
            $assignedById,
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

}