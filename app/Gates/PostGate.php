<?php

namespace App\Gates;
use Illuminate\Auth\Access\Response;

class PostGate {
    public function allowed($user , $id){
        return $user->id === $id;
    }

    public function allowedAction($user , $id){
        return $user->id === $id ? Response::allow() : Response::deny('You are not authorize');
    }
}