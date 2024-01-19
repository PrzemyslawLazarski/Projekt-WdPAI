<?php

class Question {
    private $question;
    private $answera;
    private $answerb;
    private $answerc;
    private $answerd;
    private $answercorrect;


// TODO ID QUIZU DODAĆ !!! ZEBY BYŁO WIADOME do jakiego quizu naleza pytania
    public function __construct($question, $answera, $answerb,$answerc,$answerd,$answercorrect)
    {
        $this->question = $question;
        $this->answera = $answera;
        $this->answerb = $answerb;
        $this->answerc = $answerc;
        $this->answerd = $answerd;
        $this->answercorrect = $answercorrect;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getAnswera()
    {
        return $this->answera;
    }

    public function setAnswera($answera):void
    {
        $this->answera = $answera;
    }
    public function getAnswerb()
    {
        return $this->answerb;
    }


    public function setAnswerb($answerb): void
    {
        $this->answerb = $answerb;
    }
    public function getAnswerc()
    {
        return $this->answerc;
    }


    public function setAnswerc($answerc): void
    {
        $this->answerc = $answerc;
    }
    public function getAnswerd()
    {
        return $this->answerd;
    }


    public function setAnswerd($answerd): void
    {
        $this->answerd = $answerd;
    }

    public function getAnswercorrect()
    {
        return $this->answercorrect;
    }


    public function setAnswercorrect($answercorrect): void
    {
        $this->answercorrect = $answercorrect;
    }

}