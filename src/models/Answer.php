<?php
class Answer {
    private $answerText;
    private $isCorrect;

    public function __construct($answerText, $isCorrect) {
        $this->answerText = $answerText;
        $this->isCorrect = $isCorrect;
    }

    public function getAnswerText() {
        return $this->answerText;
    }

    public function getIsCorrect() {
        return $this->isCorrect;
    }
}