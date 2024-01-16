<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Quiz.php';
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
        $quizzes = $this->quizRepository->getQuizzes();
        $this->render('quizzes',['quizzes' => $quizzes]);
    }

    public function addQuiz()
    {   
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'], 
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            // TODO create new project object and save it in database
            $quiz = new Quiz($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->quizRepository->addQuiz($quiz);

            return $this->render('quizzes', [
                'quizzes' => $this->quizRepository->getQuizzes(),
                'messages' => $this->message]);
        }
        return $this->render('add-quiz', ['messages' => $this->message]);
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
