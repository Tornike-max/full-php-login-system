<?php



class SignupClass extends Dbh
{
    protected function setUser($uid, $email, $pwd)
    {
        echo 'set';
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
            // Prepare the SELECT statement
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = :uid OR users_email = :email');

            // Bind values to the placeholders
            $stmt->bindValue(':uid', $uid);
            $stmt->bindValue(':email', $email);

            // Execute the statement
            if ($stmt->execute()) {
                // Fetch the result set
                $result = $stmt->fetchAll();

                // Check if any rows were returned
                if (count($result) > 0) {
                    // User already exists
                    return false;
                } else {
                    // User does not exist
                    return true;
                }
            } else {
                // If execution fails, throw an exception or handle the error accordingly
                throw new PDOException('Error executing SQL statement');
            }
        } catch (PDOException $e) {
            // Handle PDO exception
            echo 'Error: ' . $e->getMessage();
            die();
        }
    }
}
