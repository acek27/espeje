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

    public function store(Request $request)
    {
        $this->validate($request, $this->model::$rulesCreate);
        $this->model::create([
            'keterangan' => $request->keterangan,
            'spj_id' => $request->spj_id,
            'validator_id' => Auth::user()->id
        ]);
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $data = $this->model::find($id);
        if ($request->status == 1) {
            $data->update([
                'status' => $request->status,
                'tanggal_submit' => date('Y-m-d')
            ]);
        } elseif ($request->status == 2) {
            $data->update([
                'status' => $request->status,
                'tanggal_verifikasi' => date('Y-m-d')
            ]);
        }

        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function destroy($id)
    {
        $data = $this->model::find($id);
        $data->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus!');
    }
}
