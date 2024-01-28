<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Quiz.php';
require_once __DIR__ .'/../models/Question.php';
require_once __DIR__ .'/../models/Answer.php';
require_once __DIR__.'/../repository/QuizRepository.php';


class QuizController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
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

    public function addQuiz()
    {

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'], 
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $createdAt = date('Y-m-d'); // Bieżąca data i czas
            $idAssignedBy = $_SESSION['user_id']; // ID użytkownika z sesji


            //
            $questions = [];
            $questionTexts = $_POST['questions'] ?? [];
            $answerTexts = $_POST['answers'] ?? [];
            $correctAnswers = $_POST['correct_answer'] ?? [];

            for ($i = 0; $i < count($questionTexts); $i++) {
                $questionText = $questionTexts[$i];
                $answers = [];

                for ($j = 0; $j < 4; $j++) { // Zakładając, że masz 4 odpowiedzi na pytanie
                    $answerIndex = $i * 4 + $j;
                    $isCorrect = (isset($correctAnswers[$i]) && $correctAnswers[$i] == $j) ? 1 : 0;
                    //$isCorrect =0;
                    $answers[] = new Answer($answerTexts[$answerIndex], $isCorrect);
                }
                $question = new Question($questionText, $answers);
                $questions[] = $question;
            }
            //answers

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $image = basename($_FILES['file']['name']);

            $quiz = new Quiz($title, $description, $createdAt, $idAssignedBy, $image, $questions);
            //
            $quizId = $this->quizRepository->addQuiz($quiz);
            $quiz->setId($quizId);
            //
            return $this->render('quizzes', [
                'quizzes' => $this->quizRepository->getCurrentUserQuizzes(),
                'messages' => $this->message]);
        }
        return $this->render('add-quiz', ['messages' => $this->message]);
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




}
