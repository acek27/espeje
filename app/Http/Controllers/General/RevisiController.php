<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Revisi;
use App\Models\Spj;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisiController extends Controller
{
    use Resource;

    protected $model = Revisi::class;
    protected $view = 'general.spj';
    protected $route = 'revisi';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->model::$rulesCreate);
        $this->model::create([
            'keterangan' => $request->keterangan,
            'spj_id' => $request->spj_id,
            'validator_id' => Auth::user()->id
        ]);
        $spj = Spj::findOrFail($request->spj_id);
        $spj->update(['status' => 1]);
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $this->progress($request->status, $id);
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function progress($status, $id)
    {
        $data = $this->model::find($id);
        $data->update([
            'status' => $status,
            'tanggal_submit' => date('Y-m-d')
        ]);
    }

    public function destroy($id)
    {
        $data = $this->model::find($id);
        $data->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus!');
    }
}
