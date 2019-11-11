<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Backend\UserRequest;

use Session;

class userController_prueba extends controller
{
    public function index (Request $request)
    {
        $users = User::WithTrashed();

        return view('backend.users.index');
    }

    public function form(User $users = null, Request $request)
    {
        $roles = Role::pluck('name', 'id')->toArray;

        $users = $users ?: new User;
        return view('backend.users.form')->with('users', $users)
                                         ->with('rolesData', $roles); 

    }

    
    
}