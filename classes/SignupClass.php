<?php



class SignupClass extends Dbh
{
    protected function setUser($uid, $pwd, $email)
    {

        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (:uid, :pwd, :email)');
        $hashedPass = password_hash($pwd, PASSWORD_DEFAULT);

        $stmt->bindValue(':uid', $uid);
        $stmt->bindValue(':pwd', $hashedPass);
        $stmt->bindValue(':email', $email);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new \InvalidArgumentException('Something went wrong');
        }
    }

    protected function checkUser($uid, $email)
    {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = :uid OR users_email = :email');

            $stmt->bindValue(':uid', $uid);
            $stmt->bindValue(':email', $email);

            $result = true;
            if ($stmt->execute()) {
                $data = $stmt->fetchAll();

                if (count($data) > 0) {
                    $result = false;
                } else {
                    $result = true;
                }
            } else {
                throw new PDOException('Error executing SQL statement');
            }
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }
    }
}
