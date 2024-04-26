<?php

class LoginContrClass extends LoginClass
{
    protected $pwd;
    protected $email;

    public function __construct($pwd, $email)
    {
        $this->pwd = $pwd;
        $this->email = $email;
    }

    public function loginuser()
    {
        if ($this->emptyInputs() === true) {
            header('Location: ./index.php?error=emptyinputs');
            exit();
        }
        $result = $this->checkUserLogin($this->email, $this->pwd);
        if (!empty($result)) {
            header('Location: ../includes/home.inc.php');
        }
    }

    private function emptyInputs()
    {
        $result = false;

        if (empty($this->pwd) || empty($this->email)) {
            $result = true;
        }
        return $result;
    }
}
