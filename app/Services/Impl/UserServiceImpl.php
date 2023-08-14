<?php 

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{

    private array $users = [
        "alfian" => "rahasia"
    ];

    public function login(string $user, string $password): bool
    {
        if(!isset($this->users[$user])){
            return false;
        }

        $correctPassword = $this->users[$user];
        // simple way
        return $password == $correctPassword;
        // manual way
        // if( $password == $correctPassword){
        //     return true;
        // } else {
        //     return false;
        // }
    }
}

?>