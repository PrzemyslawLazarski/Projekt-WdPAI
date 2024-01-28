<?php

class Quiz {
    private $title;
    private $description;
    private $createdAt;
    private $idAssignedBy;
    private $image;
    private $questions; // Lista pytań


    public function __construct($title, $description, $createdAt, $idAssignedBy, $image, $questions) {
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->idAssignedBy = $idAssignedBy;
        $this->image = $image;
        $this->questions = $questions;
    }


    public function getTitle()
    {
        return $this->title;
    }
    public function getQuestions() {
        return $this->questions;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

}