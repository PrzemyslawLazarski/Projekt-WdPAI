<?php

class Question {
    private $questionText;
    private $answers;

    public function __construct($questionText, $answers) {
        $this->questionText = $questionText;
        $this->answers = $answers;
    }

    public function getQuestionText() {
        return $this->questionText;
    }

    public function getAnswers() {
        return $this->answers;
    }
}

