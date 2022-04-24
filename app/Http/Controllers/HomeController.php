<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $re = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        for ($i = 0; $i < 12; $i++) {
            $month = date($i + 1);
            $start = date('Y') . '-' . ($month) . '-21';
            $end = date('Y') . '-' . ($month + 1) . '-20';
            $data = Spj::whereBetween('created_at', [$start, $end])->get()->count();
            $re[$i] = $data;
        }
        $bar = implode(', ', $re);
        return view('home', compact('bar'));
    }
}
