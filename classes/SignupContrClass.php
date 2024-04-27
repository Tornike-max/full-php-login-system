<?php


class SignupContrClass extends SignupClass
{
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdrepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
    }

    public function signupuser()
    {
        if ($this->emptyInputs() === false) {
            header('Location: ../index.php?error=emptyInputs');
            echo 'exit inputs';
            exit();
        }
        if ($this->invalidUid() === false) {
            header('Location: ../index.php?error=invalidUid');
            echo 'exit uid';
            exit();
        }
        if ($this->invalidPwd() === false) {
            header('Location: ../index.php?error=invalidPwd');
            echo 'exit pwd';
            exit();
        }
        if ($this->invalidEmail() === false) {
            header('Location: ../index.php?error=invalidEmail');
            echo 'exit email';
            exit();
        }
        if ($this->uidTakenCheck() === false) {
            header('Location: ../index.php?error=alreadyExists');
            echo 'exit taken';
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    private function emptyInputs()
    {
        $result = true;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)) {
            $result = false;
        }
        return $result;
    }

    private function invalidUid()
    {
        $result = true;
        if (!preg_match("/^[a-zA-Z0-9]+$/", $this->uid)) {
            $result = false;
        }
        return $result;
    }

    private function invalidPwd()
    {
        $result = true;
        if ($this->pwd !== $this->pwdrepeat) {
            $result = false;
        }
        return $result;
    }


    private function invalidEmail()
    {
        $result = true;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        $result = $this->checkUser($this->uid, $this->email);
        return $result;
    }

    public function fetchUserId($uid)
    {
        $userId = $this->getUserId($uid);
        return $userId[0]['users_id'];
    }
}
