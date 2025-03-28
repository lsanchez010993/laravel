<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController
{

    public function store(){

        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'subject'=> 'required',
            'content' => 'required|min:10'
    ]);
    return 'dades validades!!!';

    }
}

