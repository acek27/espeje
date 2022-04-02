<?php

namespace App\Http\Controllers\Rekening;

use App\Http\Controllers\Controller;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UraianController extends Controller
{
    use Resource;

    protected $model = Uraian::class;
    protected $view = 'rekening.uraian';
    protected $route = 'uraian';

    public function __construct()
    {
        $this->middleware('can:CRUD Rekening');
    }

    public function index()
    {
        $sub = Subkegiatan::where('status', 1)->pluck('nama_sub', 'kode_rek');
        return view($this->view . '.index', compact('sub'));
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
        return view($this->view . '.edit', compact('data', 'sub'));
    }

    public function anyData()
    {
        return DataTables::of($this->model::query())
            ->addColumn('status', function ($data) {
                $a = '';
                if ($data->status == 1) {
                    $a = 'Aktif';
                } else {
                    $a = 'Nonaktif';
                }
                return $a;
            })
            ->addColumn('anggaran', function ($data) {

                return 'Rp. ' . number_format($data->jumlah, 0, ',', '.');
            })
            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . $del;
            })
            ->make(true);
    }

    public function filter($kode_rek)
    {
        return DataTables::of($this->model::where('sub_id', $kode_rek))
            ->addColumn('status', function ($data) {
                $a = '';
                if ($data->status == 1) {
                    $a = 'Aktif';
                } else {
                    $a = 'Nonaktif';
                }
                return $a;
            })
            ->addColumn('anggaran', function ($data) {

                return 'Rp. ' . number_format($data->jumlah, 0, ',', '.');
            })
            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . $del;
            })
            ->make(true);
    }

}
