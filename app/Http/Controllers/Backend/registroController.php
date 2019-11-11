<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Backend\UserRequest;
use App\Cargo;

use Session;

class registroController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withTrashed();
        $cargos = Cargo::withTrashed()->pluck('nombre', 'id')->toArray();
        if ($request->has('cargos') && $request->get('cargos') != null) {
            $users = $users->join('cargos','users.cargo_id','=','cargos.id')
			                        ->where('cargos.id', '=', $request->get('cargos'));
        }

        $users = $users->paginate(10);
        return view('backend.users.index')->with('usersData', $users)
                                            ->with('cargosData', $cargos);

    }

    public function form(User $users = null,Request $request)
    {
        $roles = Role::pluck('name', 'id')->toArray();
        $cargos = \App\Cargo::pluck('nombre', 'id')->toArray();
        
        $users = $users ?: new User;
        return view('backend.users.form')->with('users', $users)
                                        ->with('rolesData', $roles)
                                        ->with('cargosData', $cargos);
    }

    public function post(UserRequest $request, User $user)
    {
        $user = User::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        if (!$user->exists) {
            $this->validate($request,array(
                'nombre' => 'required:users',
                'apellidos' => 'required:users',
                'rol' => 'required:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|same:password2',
                'password2' => 'required:users',
            ));    
        }else{
            $usuarios = User::withTrashed()->pluck('email', 'id')->toArray();
            foreach($usuarios as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('email')){
                    $this->validate($request,array(
                        'nombre' => 'required:users',
                        'apellidos' => 'required:users',
                        'rol' => 'required:users',
                        'email' => 'required|email|unique:users',
                        'password' => 'required|same:password2',
                        'password2' => 'required:users',
                    ));  
                }
            }
        }
        $user->id = $request->get('id');
        $user->nombre = $request->get('nombre');
        $user->apellidos = $request->get('apellidos');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->cargo_id = $request->get('cargo_id');

        $user->save();

        $user->assignRole($request->get('rol'));

        return redirect()->route('users.index');
    }

    public function delete(User $users)
    {
        $users->delete();

        return redirect()->back();
    }

    public function restore($userId)
    {
        $users = User::withTrashed()->find($userId);
        $users->restore();
        
        return redirect()->back();
    }

    public function forceDelete($userId)
    {
        $users = User::withTrashed()->find($userId);
        $users->forceDelete();
        
        return redirect()->back();
    } 
}
