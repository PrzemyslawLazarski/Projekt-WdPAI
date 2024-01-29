<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';
require_once __DIR__.'/../models/Answer.php';

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
            $quiz['createdAt'],
            $quiz['idAssignedBy'],
            $quiz['image'],
            $quiz['questions']


        );
    }
    public function addQuiz(Quiz $quiz): int {
        try {
            session_start();
            $date = new DateTime();
            $userId = $_SESSION['user_id'];

            // Uzyskaj połączenie PDO
            $pdo = $this->database->connect();

            // Rozpocznij transakcję
            $pdo->beginTransaction();

            // Dodaj quiz
            $stmtQuiz = $pdo->prepare("
            INSERT INTO quizzes (title, description, created_at, id_assigned_by, image)
            VALUES (?, ?, ?, ?, ?)
        ");

            $stmtQuiz->execute([
                $quiz->getTitle(),
                $quiz->getDescription(),
                $date->format('Y-m-d'),
                $userId,
                $quiz->getImage()
            ]);

            // Pobierz ID dodanego quizu
            $quizId = $pdo->lastInsertId();

            // Dodaj pytania
            foreach ($quiz->getQuestions() as $question) {
                $stmtQuestion = $pdo->prepare("
                INSERT INTO questions (quiz_id, question_text)
                VALUES (?, ?)
            ");

                $stmtQuestion->execute([$quizId, $question->getQuestionText()]);

                // Pobierz ID dodanego pytania
                $questionId = $pdo->lastInsertId();

                // Dodaj odpowiedzi
                foreach ($question->getAnswers() as $answer) {
                    $stmtAnswer = $pdo->prepare("
                    INSERT INTO answers (question_id, answer_text, is_correct)
                    VALUES (?, ?, ?)
                ");

                    $isCorrectValue = $answer->getIsCorrect() ? 1 : 0;
                    $stmtAnswer->execute([$questionId, $answer->getAnswerText(), $isCorrectValue]);
                }
            }

            // Zakończ transakcję
            $pdo->commit();

            return (int)$quizId;
        } catch (Exception $e) {
            // W razie wystąpienia błędu, cofnij transakcję
            $pdo->rollBack();
            throw $e; // Przekaż błąd do wyższego poziomu
        }
    }

    public function removeQuiz(int $quizId): void {
        session_start();

        $pdo = $this->database->connect();

        $stmt = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");

        $stmt->execute([$quizId]);


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
                $quiz['createdAt'],
                $quiz['idAssignedBy'],
                $quiz['image'],
                $quiz['questions'],
                $quiz['id']


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
                $quiz['createdAt'],
                $quiz['idAssignedBy'],
                $quiz['image'],
                $quiz['questions'],
                $quiz['id']



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
/*
    function getQuizById(int $quizId) {

            $stmt = $this->database->connect()->prepare("SELECT * FROM quizzes WHERE id = :quizId");
            $stmt->bindParam(':quizId', $quizId, PDO::PARAM_INT);

            // Wykonanie zapytania
            $stmt->execute();

            // Pobranie wyniku
            $quiz = $stmt->fetch(PDO::FETCH_OBJ);

            return $quiz;


    }
*/

    public function deleteQuizByTitle(string $searchString)
    {


        $stmt = $this->database->connect()->prepare('
            DELETE FROM quizzes WHERE title LIKE :del

        ');
        $stmt->bindParam(':del', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
/*
    public function getQuizQuestions($quizId) {
        $stmt = $this->database->connect()->prepare("
        SELECT q.id AS question_id, q.question_text, a.id AS answer_id, a.answer_text, a.is_correct
        FROM questions q
        JOIN answers a ON q.id = a.question_id
        WHERE q.quiz_id = :quizId
    ");

        $stmt->bindParam(':quizId', $quizId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Organizujemy dane w strukturę, którą łatwo będzie przetworzyć w kodzie JavaScript
        $questions = [];
        foreach ($result as $row) {
            $questionId = $row['question_id'];

            if (!isset($questions[$questionId])) {
                $questions[$questionId] = [
                    'question_text' => $row['question_text'],
                    'answers' => []
                ];
            }

            $questions[$questionId]['answers'][] = [
                'answer_id' => $row['answer_id'],
                'answer_text' => $row['answer_text'],
                'is_correct' => $row['is_correct']
            ];
        }

        return $questions;
    }
*/
    public function getQuestionsForQuiz($quizId): array {
        $questions = [];
        $pdo = $this->database->connect();

        $stmt = $pdo->prepare("
        SELECT q.id, q.question_text, a.id as answer_id, a.answer_text, a.is_correct
        FROM questions q
        JOIN answers a ON q.id = a.question_id
        WHERE q.quiz_id = ?
        ORDER BY q.id, a.id
    ");
        $stmt->execute([$quizId]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!isset($questions[$row['id']])) {
                $questions[$row['id']] = [
                    'question_text' => $row['question_text'],
                    'answers' => []
                ];
            }

            $questions[$row['id']]['answers'][] = [
                'answer_id' => $row['answer_id'],
                'answer_text' => $row['answer_text'],
                'is_correct' => $row['is_correct']
            ];
        }

        return array_values($questions);
    }

}