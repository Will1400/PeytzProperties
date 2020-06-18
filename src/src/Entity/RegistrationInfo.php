<?php

namespace App\Entity;

class RegistrationInfo
{
    protected $email;
    protected $username;
    protected $password;

    public function GetEmail()
    {
        return $this->email;
    }

    public function SetEmail($email)
    {
        $this->email = $email;
    }

    public function GetUsername()
    {
        return $this->username;
    }

    public function Setusername($username)
    {
        $this->username = $username;
    }

    public function Getpassword()
    {
        return $this->password;
    }

    public function Setpassword($password)
    {
        $this->password = $password;
    }
}
