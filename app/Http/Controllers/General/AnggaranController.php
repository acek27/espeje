<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    protected $model = Subkegiatan::class;
    protected $view = 'general.anggaran';
    protected $route = 'anggaran';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = $this->model::all();
        return view($this->view . '.index', compact('data'));
    }
}
