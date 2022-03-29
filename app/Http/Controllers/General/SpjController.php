<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Spj;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use App\Traits\Resource;
use Illuminate\Http\Request;

class SpjController extends Controller
{
    use Resource;

    protected $model = Spj::class;
    protected $view = 'general.spj';
    protected $route = 'spj';

    public function __construct()
    {
//        $this->middleware('auth')->except(['notification']);
    }

    public function create()
    {
        $sub = Subkegiatan::where('status', 1)->pluck('nama_sub', 'kode_rek');
        return view($this->view . '.create', compact('sub'));
    }

    public function listuraian(Request $request, $id)
    {
        $data = Uraian::where('status', 1)
            ->where('sub_id', $id)->get();
        return response()->json($data);
    }
}
