<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Quiz.php';
require_once __DIR__ .'/../models/Question.php';
require_once __DIR__ .'/../models/Answer.php';
require_once __DIR__.'/../repository/QuizRepository.php';

class QuizController extends AppController {

    const MAX_FILE_SIZE = 1800*1800;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $quizRepository;

    public function __construct()
    {
        parent::__construct();
        $this->quizRepository = new QuizRepository();
    }

    public function quizzes()
    {
        $quizzes = $this->quizRepository->getCurrentUserQuizzes();
        $this->render('quizzes',['quizzes' => $quizzes]);
    }
    public function discover()
    {
        $discover = $this->quizRepository->getQuizzes();
        $this->render('discover',['quizzes' => $discover]);
    }
    public function adminPanel()
    {
        $adminPanel = $this->quizRepository->getQuizzes();
        $this->render('adminPanel',['quizzes' => $adminPanel]);

    }

    public function getQuestionsForQuiz($quizId = null)
    {
        if (!$quizId) {
            $quizId = $_GET['quizId'] ?? null;
        }

        if ($quizId) {
            $quizRepository = new QuizRepository();
            $questions = $quizRepository->getQuestionsForQuiz($quizId);

            if (!empty($questions)) {
                header('Content-type: application/json');
                http_response_code(200);
                echo json_encode($questions);
            } else {
                http_response_code(404); // Nie znaleziono
                echo json_encode(['error' => 'Nie znaleziono pytań dla tego quizu']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Brak ID quizu']);
        }
    }


    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));

            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->quizRepository->getQuizByTitle($decoded['search']));
        }
    }

    public function delete()
    {
        try {
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

            if ($contentType === "application/json") {
                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);
                $quizExists = $this->quizRepository->checkIfQuizExists($decoded['del']);

                if (!$quizExists) {
                    throw new Exception("Quiz o takim tytule nie istnieje.");
                }
                $this->quizRepository->deleteQuizByTitle($decoded['del']);

                header('Content-type: application/json');
                echo json_encode(["message" => "Quiz został usunięty."]);
            } else {
                throw new Exception("Nieprawidłowy typ zawartości.");
            }
        } catch (Exception $e) {
            header('Content-type: application/json');
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
    public function deleteById()
    {
        try {
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

            if ($contentType === "application/json") {
                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);

                $this->quizRepository->removeQuiz($decoded['quizId']);

                header('Content-type: application/json');
                echo json_encode(["message" => "Quiz został usunięty."]);
            } else {
                throw new Exception("Nieprawidłowy typ zawartości.");
            }
        } catch (Exception $e) {
            header('Content-type: application/json');
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

public function validateQuiz()
{
    if ($this->isPost()) {
        $messages = [];

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        if (empty($title)) {
            $messages[] = "Please add a quiz title.";
        }

        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        if (empty($description)) {
            $messages[] = "Please add a description for the quiz.";
        }

        $imageUploaded = is_uploaded_file($_FILES['file']['tmp_name']);
        if (!$imageUploaded) {
            $messages[] = "Please upload an image for the quiz.";
        } elseif (!$this->validate($_FILES['file'])) {
            $messages[] = "Invalid image file.";
        }

        $questionTexts = $_POST['questions'] ?? [];
        $answerTexts = $_POST['answers'] ?? [];
        $correctAnswers = $_POST['correct_answer'] ?? [];
        foreach ($questionTexts as $index => $questionText) {
            if (empty($questionText)) {
                $messages[] = "Question " . ($index + 1) . " is empty.";
            }

            for ($i = 0; $i < 4; $i++) {
                if (empty($answerTexts[$index * 4 + $i])) {
                    $messages[] = "Answer " . ($i + 1) . " in question " . ($index + 1) . " is empty.";
                }
            }

            if (!isset($correctAnswers[$index])) {
                $messages[] = "No correct answer selected for question " . ($index + 1) . ".";
            }
        }

        if (!empty($messages)) {
            return $this->render('add-quiz', [
                'messages' => $messages,
                'formData' => [
                    'title' => $title,
                    'description' => $description,
                    'questions' => $questionTexts,
                    'answers' => $answerTexts,
                    'correct_answers' => $correctAnswers
                ]
            ]);
        }

        if ($imageUploaded) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $image = basename($_FILES['file']['name']);
        }

        $createdAt = date('Y-m-d H:i:s');
        $idAssignedBy = $_SESSION['user_id'];

        $this->addQuiz($title,$description,$createdAt,$idAssignedBy,$image,$questionTexts,$answerTexts);
        return;
    }

    return $this->render('add-quiz', ['messages' => $this->message]);
}
    public function addQuiz($title,$description,$createdAt,$idAssignedBy,$image,$questionTexts,$answerTexts)
    {

        $questions = [];
        $correctAnswers = $_POST['correct_answer'] ?? [];

        for ($i = 0; $i < count($questionTexts); $i++) {
            $questionText = $questionTexts[$i];
            $answers = [];

            for ($j = 0; $j < 4; $j++) {
                $answerIndex = $i * 4 + $j;
                $isCorrect = (isset($correctAnswers[$i]) && $correctAnswers[$i] == $j) ? 1 : 0;

                $answers[] = new Answer($answerTexts[$answerIndex], $isCorrect);
            }
            $question = new Question($questionText, $answers);
            $questions[] = $question;
        }

        $quiz = new Quiz($title, $description, $createdAt, $idAssignedBy, $image, $questions);
        $quizId = $this->quizRepository->addQuiz($quiz);
        $quiz->setId($quizId);

        return $this->render('quizzes', [
            'quizzes' => $this->quizRepository->getCurrentUserQuizzes(),
            'messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
    public function searchDiscover()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));

            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->quizRepository->getQuizByTitleDiscover($decoded['searchDiscover']));
        }
    }
}
