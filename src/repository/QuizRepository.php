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

            $pdo = $this->database->connect();

            $pdo->beginTransaction();

            $stmtQuiz = $pdo->prepare("
            INSERT INTO quizzes (title, description, created_at, id_assigned_by, image)
            VALUES (?, ?, ?, ?, ?)
        ");

            $stmtQuiz->execute([
                $quiz->getTitle(),
                $quiz->getDescription(),
                $date->format('Y-m-d H:i:s'),
                $userId,
                $quiz->getImage()
            ]);

            $quizId = $pdo->lastInsertId();

            foreach ($quiz->getQuestions() as $question) {
                $stmtQuestion = $pdo->prepare("
                INSERT INTO questions (quiz_id, question_text)
                VALUES (?, ?)
            ");

                $stmtQuestion->execute([$quizId, $question->getQuestionText()]);

                $questionId = $pdo->lastInsertId();

                foreach ($question->getAnswers() as $answer) {
                    $stmtAnswer = $pdo->prepare("
                    INSERT INTO answers (question_id, answer_text, is_correct)
                    VALUES (?, ?, ?)
                ");

                    $isCorrectValue = $answer->getIsCorrect() ? 1 : 0;
                    $stmtAnswer->execute([$questionId, $answer->getAnswerText(), $isCorrectValue]);
                }
            }

            $pdo->commit();

            return (int)$quizId;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
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
            SELECT * FROM quizzes ORDER BY created_at DESC
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
            SELECT * FROM quizzes WHERE id_assigned_by = :userId ORDER BY created_at DESC
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
        session_start();
        $searchString = '%' . strtolower($searchString) . '%';
        $userId = $_SESSION['user_id'];

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM quizzes WHERE id_assigned_by = :userId AND ((LOWER(title) LIKE :search OR LOWER(description) LIKE :search))
    ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT); // Dodaj tę linię
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkIfQuizExists(string $title): bool {
        $pdo = $this->database->connect();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM quizzes WHERE title = ?");
        $stmt->execute([$title]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
    public function deleteQuizByTitle(string $searchString)
    {

        $stmt = $this->database->connect()->prepare('
            DELETE FROM quizzes WHERE title LIKE :del
        ');
        $stmt->bindParam(':del', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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