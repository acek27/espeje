<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Spj;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view($this->view . '.edit', compact('sub', 'data'));
    }

    public function store(Request $request)
    {
        $request->request->add(['pptk_id' => Auth::user()->id]);
        $this->validate($request, $this->model::$rulesCreate);
        $this->model::create($request->all());
        return redirect(route($this->route . '.index'))->with('status', 'Data berhasil disimpan!');
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
            ->addColumn('progress', function ($data) {
                $progress = 0;
                $bar = '';
                if ($data->status == 0) {
                    $progress;
                    $bar= 'bg-danger';
                } elseif ($data->status == 1) {
                    $progress = 25;
                    $bar= 'bg-danger';
                } elseif ($data->status == 2) {
                    $progress = 50;
                    $bar= 'bg-orange';
                } elseif ($data->status == 3) {
                    $progress = 75;
                    $bar= 'bg-warning';
                } else {
                    $progress = 100;
                    $bar= 'bg-success';
                }
                $result = '<div data-toggle="tooltip" title="' . $progress . '" class="progress-group"><strong>' . number_format($progress, 0, '.', '') . '%</strong>
                            Complete<div class="progress progress-sm">
                                <div class="progress-bar ' . $bar . '"
                                     style="width: ' . $progress . '%"></div>
                            </div>
                            <!-- /.progress-group -->
                        </div>';
                return $result;
            })
            ->addColumn('status', function ($data) {
                $a = '';
                if ($data->status == 0) {
                   $a = 'Diajukan';
                } elseif ($data->status == 1) {
                    $a = 'Revisi';
                } elseif ($data->status == 2) {
                    $a = 'Disetujui PU';
                } elseif ($data->status == 3) {
                    $a = 'Disetujui LS/GU';
                } else {
                    $a = 'Selesai';
                }
                return $a;
            })
            ->addColumn('jumlah', function ($data) {

                return 'Rp. ' . number_format($data->jumlah, 0, ',', '.');
            })
            ->addColumn('action', function ($data) {
                $view = '<a href="' . route($this->route . '.show', $data->id) . '"><i class="fa fa-search text-info"></i></a>';
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                return $view . '&nbsp' .'&nbsp' .$edit . '&nbsp' . '&nbsp' . $del;
            })
            ->rawColumns(['action', 'progress'])
            ->make(true);
    }
}
