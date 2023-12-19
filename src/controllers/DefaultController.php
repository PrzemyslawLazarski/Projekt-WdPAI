<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function login()
    {
        $this->render('login');
    }
    public function index()
    {
        $this->render('main');
    }

    public function aboutus()
    {
        $this->render('aboutus');
    }

    public function features()
    {
        $this->render('features');
    }

    public function main()
    {
        $this->render('main');
    }

    public function register()
    {
        $this->render('register');
    }

    public function howitworks()
    {
        $this->render('howitworks');
    }

    public function quiz()
    {
        $this->render('quiz');
    }

    public function dashboard()
    {
        $this->render('dashboard');
    }
    public function profile()
    {
        $this->render('profile');
    }
}