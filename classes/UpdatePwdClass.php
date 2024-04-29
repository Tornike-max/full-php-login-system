<?php

class UpdatePwdClass extends Dbh
{
    protected function setNewPwd($pwd, $email)
    {
        $result = false;
        $user = $this->getUserByEmail($email);
        if (empty($user[0]['users_pwd']) || empty($pwd)) {
            header('Location: ./includes/update.inc.php?message=usernotfound');
            return null;
        }

        $newPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $oldPwd = $user[0]['users_pwd'];


        $stmt = $this->connect()->prepare('update users set users_pwd = :usersPwd where users_pwd = :oldPwd');
        $stmt->bindValue(':usersPwd', $newPwd);
        $stmt->bindValue(':oldPwd', $oldPwd);

        if ($stmt->execute()) {
            $result = true;
            return $result;
        } else {
            throw new \InvalidArgumentException('Something went wrong');
        }
        return $result;
    }
    protected function getUserByEmail($email)
    {
        $stmt = $this->connect()->prepare('select * from users where users_email = :email');
        $stmt->bindValue(':email', $email);

        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ./includes/update.inc.php?message=somethingwentwrong');
        }

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
}
