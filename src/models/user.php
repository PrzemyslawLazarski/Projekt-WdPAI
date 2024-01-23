<?php

class User {
    private $email;
    private $password;
    private $nickname;



    public function __construct(
        string $nickname,
        string $email,
        string $password



    ) {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;



    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword():string
    {
        return $this->password;
    }
    public function getNickname():string
    {
        return $this->nickname;
    }

}