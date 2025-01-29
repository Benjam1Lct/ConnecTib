<?php

namespace App\Controllers;

class Legals extends BaseController
{
    public function legals(): string
    {
        return view('legals');
    }
}
