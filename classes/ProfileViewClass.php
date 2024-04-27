<?php

class ProfileViewClass extends ProfileInfoClass
{
    public function getAbout($userId)
    {
        $result = $this->getProfileInfo($userId);
        return $result[0]['profiles_about'];
    }

    public function getIntroTitle($userId)
    {
        $result = $this->getProfileInfo($userId);
        return $result[0]['profiles_introtitle'];
    }
    public function getIntroText($userId)
    {
        $result = $this->getProfileInfo($userId);
        return $result[0]['profiles_introtext'];
    }
}
