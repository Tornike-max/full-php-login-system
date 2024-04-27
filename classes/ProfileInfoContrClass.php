<?php

class ProfileInfoContrClass extends ProfileInfoClass
{
    protected $userId;
    protected $uid;

    public function __construct($userId, $uid)
    {
        $this->userId = $userId;
        $this->uid = $uid;
    }

    public function defaultProfile()
    {
        $profileAbout = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula velit nec aliquet facilisis. Proin eget consectetur magna. Nulla facilisi. Sed vel magna ut lorem fermentum faucibus.';
        $profileTitle = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit';
        $profileText = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit';

        $this->addNewProfileInfo($profileAbout, $profileTitle, $profileText, $this->userId);
    }

    public function updateProfile(
        $profileAbout,
        $profileTitle,
        $profileText,
        $userId
    ) {
        if ($this->checkInputs(
            $profileAbout,
            $profileTitle,
            $profileText,
        ) === true) {
            header('Location: ../includes/profile.inc.php');
            exit();
        }
        $this->setNewProfileInfo($profileAbout, $profileTitle, $profileText, $userId);
    }

    protected function getProfile()
    {
        if (empty($this->userId)) {
            header('Location: ../includes/profile.inc.php?message=nouserid');
            exit();
            $this->getProfileInfo($this->userId);
        }
    }

    protected function checkInputs(
        $profileAbout,
        $profileTitle,
        $profileText,
    ) {
        $result = false;
        if (empty($profileAbout) || empty($profileTitle) || empty($profileText)) {
            $result = true;
        }
        return $result;
    }
}
