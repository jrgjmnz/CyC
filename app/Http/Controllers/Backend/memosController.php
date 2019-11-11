<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Memo;

class memosController extends Controller
{
    public function index(Request $request)
    {
        $memos = Memo::withTrashed();

        $$memos = $$memos->paginate(10);
        return view('backend.$memos.index')->with('$memosData', $$memos);
    }
}
