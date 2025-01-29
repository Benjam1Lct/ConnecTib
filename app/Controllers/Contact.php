<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function contact(): string
    {
        return view('contact');
    }
}
