<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    use Resource;

    protected $model = User::class;
    protected $view = 'permission';
    protected $route = 'permission';

    public function __construct()
    {
//        $this->middleware('auth')->except(['notification']);
    }

    public function store(Request $request)
    {
        $data = $this->model::findOrFail($request->user_id);
        $data->roles()->syncWithoutDetaching($request->role_id);
        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view($this->view . '.show', compact('data', 'roles'));
    }

    public function delete($id, Request $request)
    {
        $data = $this->model::findOrFail($id);
        $data->roles()->detach($request->role_id);
        return redirect()->back()->with('status', 'Data berhasil dihapus!');
    }

    public function anyData()
    {
        return DataTables::of($this->model::query())
            ->addColumn('action', function ($data) {
                $view = '<a href="' . route($this->route . '.show', [$this->route => $data->id]) . '"><i class="fa fa-search text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"> <i class="fa fa-trash text-danger"></i></a>';
                return $view . '&nbsp' . '&nbsp' . $del;
            })
            ->make(true);
    }

}
