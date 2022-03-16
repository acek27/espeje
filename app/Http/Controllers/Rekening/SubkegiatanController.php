<?php

namespace App\Http\Controllers\Rekening;

use App\Http\Controllers\Controller;
use App\Models\Subkegiatan;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubkegiatanController extends Controller
{
    use Resource;

    protected $model = Subkegiatan::class;
    protected $view = 'rekening.subkegiatan';
    protected $route = 'subkegiatan';

    public function __construct()
    {
//        $this->middleware('auth')->except(['notification']);
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
            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . $del;
            })
            ->make(true);
    }

}
