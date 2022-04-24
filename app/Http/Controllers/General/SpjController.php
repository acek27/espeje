<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Spj;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use App\Models\User;
use App\Notifications\TelegramNotification;
use App\Traits\Resource;
use Carbon\Carbon;
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
        $this->middleware('auth');
    }

    public function index()
    {
        $month = date('m');
        $start = date('Y') . '-' . ($month) . '-21';
        $end = date('Y') . '-' . ($month + 1) . '-20';
        if (Auth::user()->can('CRUD SPJ')) {
            $data = $this->model::where('bidang_id', Auth::user()->role_id)->whereBetween('created_at', [$start, $end])->get();
//            $data = $this->model::where('bidang_id', Auth::user()->role_id)->whereBetween('created_at', [$start, $end])->get();
        } else {
            $data = $this->model::whereBetween('created_at', [$start, $end])->get();

        }
        return view($this->view . '.index', compact('data'));
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
        $data = Uraian::where('kode_rek', $request->uraian_id)->first()->saving;
        if ($data - $request->jumlah < 0) {
            return redirect()->back()->with('error', 'Anggaran tidak mencukupi!');
        }
        $request->request->add(['pptk_id' => Auth::user()->id, 'bidang_id' => Auth::user()->role_id]);
        $this->validate($request, $this->model::$rulesCreate);
        $this->model::create($request->all());
        return redirect(route($this->route . '.index'))->with('status', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $data = Uraian::where('kode_rek', $request->uraian_id)->first()->saving;
        if ($data - $request->jumlah < 0) {
            return redirect()->back()->with('error', 'Anggaran tidak mencukupi!');
        }
        $data = $this->model::findOrFail($id);
        $data->update($request->all());
        $link = "";
        foreach ($data->document as $doc) {
            $link .= "\r\n" . $_SERVER['SERVER_ADDR'];
        }
        $notif = User::findOrFail($data->pptk_id);
        if ($data->status == 4) {
            $notif->notify(new TelegramNotification([
                'text' => "INFORMASI SIPEJE! \r\n Nomor Rekening Uraian: "
                    . $data->uraian_id . "\r\n Nama Uraian: "
                    . $data->uraian->nama_uraian . "\r\n Nama Uraian: "
                    . Carbon::parse($data->created_at)->isoFormat('D MMMM Y') . "\r\n Status: Selesai"
            ]));
        }
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function listuraian(Request $request)
    {
        $data = Uraian::where('status', 1)
            ->where('sub_id', $request->id)->get();
        return response()->json($data);
    }

    public function rat(Request $request)
    {
        $data = Uraian::where("kode_rek", $request->id)->first();
        return response()->json($data);
    }


    public function jenis(Request $request, $id)
    {
        $data = $this->model::findOrFail($id);
        $data->update($request->all());
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function anyData(Request $request)
    {
        if (Auth::user()->can('CRUD SPJ')) {
            if ($request->bulan == 0 && $request->tahun == 0) {
                $query = $this->model::with('uraian')
                    ->where('bidang_id', Auth::user()->role_id);
            } else {
                $query = $this->model::with('uraian')
                    ->whereMonth('created_at', $request->bulan)
                    ->whereYear('created_at', $request->tahun)
                    ->where('bidang_id', Auth::user()->role_id);
            }

        } else {
            if ($request->bulan == 0 && $request->tahun == 0) {
                $query = $this->model::with('uraian');
            } else {
                $query = $this->model::with('uraian')
                    ->whereMonth('created_at', $request->bulan)
                    ->whereYear('created_at', $request->tahun);
            }

        }
        return DataTables::of($query)
            ->addColumn('bidang', function ($data) {
                $bidang = "";
                if ($data->bidang_id == 1) {
                    $bidang = "Tata Usaha";
                } elseif ($data->bidang_id == 2) {
                    $bidang = "Rumah Tangga";
                } elseif ($data->bidang_id == 3) {
                    $bidang = "perlengkapan";
                }
                return $bidang;
            })
            ->addColumn('progress', function ($data) {
                $progress = 0;
                $bar = '';
                if ($data->status == 0) {
                    $progress;
                    $bar = 'bg-danger';
                } elseif ($data->status == 1) {
                    $progress = 25;
                    $bar = 'bg-danger';
                } elseif ($data->status == 2) {
                    $progress = 50;
                    $bar = 'bg-orange';
                } elseif ($data->status == 3) {
                    $progress = 75;
                    $bar = 'bg-warning';
                } else {
                    $progress = 100;
                    $bar = 'bg-success';
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
            ->addColumn('jumlah', function ($data) {

                return 'Rp. ' . number_format($data->jumlah, 0, ',', '.');
            })
            ->addColumn('action', function ($data) {
                $view = '<a href="' . route($this->route . '.show', $data->id) . '"><i class="fa fa-search text-info"></i></a>';
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                if (Auth::user()->can('CRUD SPJ')) {
                    if ($data->status >= 3) {
                        return $view;
                    } else {
                        return $view . '&nbsp' . '&nbsp' . $edit . '&nbsp' . '&nbsp' . $del;
                    }
                } elseif (Auth::user()->can('Validasi Pertama') || Auth::user()->can('Validasi Lanjutan') || Auth::user()->can('View SPJ')) {
                    return $view;
                }
            })
            ->rawColumns(['action', 'progress'])
            ->make(true);
    }

    //upload
    public function upload($id)
    {
        $data = Spj::findOrFail($id);
        return view($this->view . '.fileUpload', compact('data'));
    }

    public function storeDoc($id, Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $this->validate($request, [
                'file' => 'mimes:pdf,jpeg,jpg,png|file|max:10240'
            ]);
            $completeFileName = $file->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '-' . uniqid() . '.' . $extension;
            $path = $file->storeAs('docTugas/' . Auth::user()->username . '/', $filename);
            Document::create([
                'nama_dokumen' => $completeFileName,
                'path' => $path,
                'spj_id' => $id
            ]);
        }
        echo $path;
        die;
    }

    public function deleteDoc(Request $request)
    {
        if ($request->id != 'undefined') {
            $id = $request->id;
            $data = Document::where('path', $id)->first();
            $file = storage_path('app/' . $data->path);
            unlink($file);
            Document::where('path', $id)->delete();
        }
    }

    public function file($id)
    {
        $poster = Document::find($id);
        if (empty($poster->path)) {
            return redirect()->back();
        }
        $file = storage_path('app/' . $poster->path);

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $poster->nama_dokumen, $headers);
    }

    public function more($status)
    {
        return view($this->view . '.more', compact('status'));
    }

    public function moredata(Request $request)
    {
        $month = date('m');
        $start = date('Y') . '-' . ($month) . '-21';
        $end = date('Y') . '-' . ($month + 1) . '-20';
        if (Auth::user()->can('CRUD SPJ')) {
            if ($request->status == 1)
                $query = $this->model::with('uraian')->where('bidang_id', Auth::user()->role_id)
                    ->whereBetween('created_at', [$start, $end])->get()
                    ->where('status', '<=', 3);
            elseif ($request->status == 2) {
                $query = $this->model::with('uraian')->where('bidang_id', Auth::user()->role_id)
                    ->whereBetween('created_at', [$start, $end])->get()
                    ->where('status', 4);
            }
        } else {
            if ($request->status == 1)
                $query = $this->model::with('uraian')->where('status', '<=', 3)
                    ->whereBetween('created_at', [$start, $end])->get();
            elseif ($request->status == 2) {
                $query = $this->model::with('uraian')->where('status', 4)
                    ->whereBetween('created_at', [$start, $end])->get();
            }

        }
        return DataTables::of($query)
            ->addColumn('bidang', function ($data) {
                $bidang = "";
                if ($data->bidang_id == 1) {
                    $bidang = "Tata Usaha";
                } elseif ($data->bidang_id == 2) {
                    $bidang = "Rumah Tangga";
                } elseif ($data->bidang_id == 3) {
                    $bidang = "perlengkapan";
                }
                return $bidang;
            })
            ->addColumn('progress', function ($data) {
                $progress = 0;
                $bar = '';
                if ($data->status == 0) {
                    $progress;
                    $bar = 'bg-danger';
                } elseif ($data->status == 1) {
                    $progress = 25;
                    $bar = 'bg-danger';
                } elseif ($data->status == 2) {
                    $progress = 50;
                    $bar = 'bg-orange';
                } elseif ($data->status == 3) {
                    $progress = 75;
                    $bar = 'bg-warning';
                } else {
                    $progress = 100;
                    $bar = 'bg-success';
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
            ->addColumn('jumlah', function ($data) {

                return 'Rp. ' . number_format($data->jumlah, 0, ',', '.');
            })
            ->addColumn('action', function ($data) {
                $view = '<a href="' . route($this->route . '.show', $data->id) . '"><i class="fa fa-search text-info"></i></a>';
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '"><i class="fa fa-edit text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                if (Auth::user()->can('CRUD SPJ')) {
                    if ($data->status >= 3) {
                        return $view;
                    } else {
                        return $view . '&nbsp' . '&nbsp' . $edit . '&nbsp' . '&nbsp' . $del;
                    }
                } elseif (Auth::user()->can('Validasi Pertama') || Auth::user()->can('Validasi Lanjutan') || Auth::user()->can('View SPJ')) {
                    return $view;
                }
            })
            ->rawColumns(['action', 'progress'])
            ->make(true);
    }

}
