<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Spj;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
    public function edit($id)
    {
        $data = $this->model::find($id);
        $sub = Subkegiatan::where('status', 1)->pluck('nama_sub', 'kode_rek');
        return view($this->view . '.edit', compact('sub','data'));
    }

    public function listuraian(Request $request, $id)
    {
        $data = Uraian::where('status', 1)
            ->where('sub_id', $id)->get();
        return response()->json($data);
    }

    public function anyData()
    {
        return DataTables::of($this->model::query())
            ->addColumn('status', function ($data) {
                $a = '';
                if ($data->status == 1) {
                    $a = 'Proses pengajuan';
                } else {
                    $a = 'Disetujui';
                }
                return $a;
            })
            ->addColumn('jumlah', function ($data) {

                return 'Rp. '. number_format($data->jumlah,0,',','.');
            })

            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . $del;
            })
            ->make(true);
    }
}
