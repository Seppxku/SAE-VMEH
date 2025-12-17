<?php

class user
{
    private string $username;
    private string $nickname;
    private string $password;
    private string $email;
    private int $age;
    public function __construct(string $username,string $nickname, int $email) {
        $this->username = $username;
        $this->nickname = $nickname;
        $this->email = $email;
    }



}