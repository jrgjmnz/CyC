<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Roles;

class rolesController extends Controller
{
    public function index(Request $request)
    {
        $roles = Roles::query();

        $roles = $roles->paginate(10);
        return view('auth.register')->with('$rolesData', $roles);
    }
}
