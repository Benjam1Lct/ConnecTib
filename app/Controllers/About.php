<?php

namespace App\Controllers;

class About extends BaseController
{
    public function about(): string
    {
        return view('about');
    }
}
