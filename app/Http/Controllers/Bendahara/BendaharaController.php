<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index() {
        return view('bendahara.dashboard');
    }
}
