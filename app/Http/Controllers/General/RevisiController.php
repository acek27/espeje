<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Revisi;
use App\Models\Spj;
use App\Traits\Resource;
use Illuminate\Http\Request;

class RevisiController extends Controller
{
    use Resource;

    protected $model = Revisi::class;
    protected $view = 'general.spj';
    protected $route = 'revisi';

    public function update(Request $request, $id)
    {
        $data = $this->model::find($id);
        $data->update(['status' => $request->status]);
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }


}
