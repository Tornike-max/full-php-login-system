<?php


class ProfileInfoClass extends Dbh
{
    public function getProfileInfo($userId)
    {
        $stmt = $this->connect()->prepare('select * from profiles where users_id = :userId');
        $stmt->bindValue(':userId', $userId);

        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ../includes/profile.inc.php?message=stmterror');
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header('Location: ../includes/profile.inc.php?message=profilenotfound');
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }

    protected function setNewProfileInfo($profileAbout, $profileTitle, $profileText, $userId)
    {
        $stmt = $this->connect()->prepare('update profiles set profiles_about = :profileAbout,
                                           profiles_introtitle = :profileTitle, 
                                           profiles_introtext = :profileText where users_id = :usersId');

        $stmt->bindValue(':usersId', $userId);
        $stmt->bindValue(':profileAbout', $profileAbout);
        $stmt->bindValue(':profileTitle', $profileTitle);
        $stmt->bindValue(':profileText', $profileText);

        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ../includes/profile.inc.php?message=stmterror');
            exit();
        }
        $stmt = null;
    }

    protected function addNewProfileInfo($profileAbout, $profileTitle, $profileText, $userId)
    {
        $stmt = $this->connect()->prepare('insert into profiles(profiles_about,profiles_introtitle,profiles_introtext,users_id)
                                        values(:profileAbout,:profileTitle,:profileText,:usersId)');
        $stmt->bindValue(':usersId', $userId);
        $stmt->bindValue(':profileAbout', $profileAbout);
        $stmt->bindValue(':profileTitle', $profileTitle);
        $stmt->bindValue(':profileText', $profileText);


        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ../includes/profile.inc.php?message=stmterror');
            exit();
        }
        $stmt = null;
    }
}
