<?php

namespace App\Http\Controllers;

use AboutService;
use Illuminate\Http\Request;

class AboutControllers extends Controller
{
   protected $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }
}
