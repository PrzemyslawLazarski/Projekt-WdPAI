<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';


class UserController extends AppController {

    private $message = [];
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function addUser()
    {

        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword=$_POST['confirmedPassword'];

        if($this->validate($nickname,$email,$password,$confirmedPassword))
        {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $user = new User($nickname,$email,$hashedPassword );

            $this->userRepository->addUser($user);

            $this->message[] = "Account successfully created";

            return $this->render('login',['messages' => $this->message]);
        }
        else
        {
            return $this->render('register', ['messages' => $this->message]);
        }
    }

    private function validate($nickname,$email,$password,$confirmedPassword): bool
    {
        if (empty($nickname) || empty($email) || empty($password) || empty($confirmedPassword)) {
            $this->message[] = "Fill in all form fields!";
            return false;
        }

        if ($password !== $confirmedPassword) {
            $this->message[] = "The passwords are not the same!";
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->message[] = "Invalid email format!";
            return false;
        }
        if ($this->userRepository->isEmailTaken($email)) {
            $this->message[] = "Provided email address is already taken!";
            return false;
        }
        if ($this->userRepository->isNicknameTaken($nickname)) {
            $this->message[] = "Provided nickname is already taken!";
            return false;
        }
        return true;
    }

}
