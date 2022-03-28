<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Spj;
use App\Models\Subkegiatan;
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
}
