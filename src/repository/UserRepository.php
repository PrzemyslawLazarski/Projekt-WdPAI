<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['nickname'],
            $user['email'],
            $user['password']


        );
    }

    public function addUser(User $user): void
    {
        $stmt = $this->database->connect()->prepare("
        INSERT INTO users (nickname, email, password)
        VALUES (?,?,?)
        ");
        $stmt->execute([
            $user->getNickname(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }

    public function isEmailTaken($email) {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM users WHERE email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) != false;
    }

    public function isNicknameTaken($nickname) {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM users WHERE nickname = ?
        ");
        $stmt->execute([$nickname]);
        return $stmt->fetch(PDO::FETCH_ASSOC) != false;
    }
}