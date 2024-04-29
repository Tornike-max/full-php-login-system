<?php

class UpdatePwdContrClass extends UpdatePwdClass
{
    protected $email;
    protected $pwd;

    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function updatePwd()
    {
        if ($this->checkProvidedData() === true) {
            header('Location: ./includes/update.inc.php');
            return false;
        }

        $result = $this->setNewPwd($this->pwd, $this->email);

        if ($result === true) {
            header('Location: ./includes/login.inc.php?message=success');
        }
    }

    protected function checkProvidedData()
    {
        $result = false;
        if (empty($this->pwd) || empty($this->email)) {
            $result = true;
        }
        return $result;
    }
}
