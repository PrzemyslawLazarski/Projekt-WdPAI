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
    public function getNicknameById($userId) {
        $stmt = $this->database->connect()->prepare('
        SELECT nickname FROM users WHERE id = :userId
    ');
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['nickname'] : null;
    }

    public function getUserIdByEmail($email) {
        $stmt = $this->database->connect()->prepare('
        SELECT id FROM users WHERE email = :email
    ');
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['id'] : null;
    }

    public function getRoleIdByEmail($email) {
        $stmt = $this->database->connect()->prepare('
        SELECT role_id FROM users WHERE email = :email
    ');
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['role_id'] : null;
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