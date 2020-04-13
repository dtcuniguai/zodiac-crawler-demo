<?php


namespace App\Service;


use App\Repository\UserRepository;

class AuthService
{
    private $userRpy;

    public function  __construct(UserRepository $userRepository)
    {
        $this->userRpy = $userRepository;
    }

    public function newUser($user)
    {

    }
}