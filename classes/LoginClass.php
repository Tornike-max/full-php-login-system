<?php

class LoginClass extends Dbh
{



    protected function checkUserLogin($email, $pwd)
    {
        try {
            $stmt = $this->connect()->prepare('select users_pwd from users where users_email = :email or users_pwd = :pwd');
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':pwd', $pwd);

            if ($stmt->execute()) {
                $pswHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = null;
                header('Location: ../index.php?error=somethingwentwrong');
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header('Location: ../index.php?error=usernotfound');
            }

            $pwdCheck = password_verify($pwd, $pswHash[0]['users_pwd']);
            var_dump($pwdCheck);

            if ($pwdCheck) {
                $stmt = $this->connect()->prepare('select * from users where users_pwd = :pwd and users_email = :email');
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':pwd', $pswHash[0]['users_pwd']);

                if ($stmt->execute()) {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    session_start();
                    $_SESSION['user_email'] = $result[0]['users_email'];
                    $_SESSION['user_uid'] = $result[0]['users_uid'];
                    return $result;
                } else {
                    $stmt = null;
                }
            }
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
        }
    }
}
