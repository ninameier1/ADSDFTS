<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Middleware\isAdmin;

class AdminController extends Controller
{
    // Constructor to apply admin middleware to all methods in this controller
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
}
