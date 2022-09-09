<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResources;
use App\Http\Resources\UserCollection;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $users = new UserCollection(User::all());
        $roles = Role::all();

        return Inertia::render('User/UserList',[ 
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function destroy(User $user)
    {
        if ( ! Auth::user()->can('user_destroy')){
            return redirect()->back()->with('warning', 'No posees los permisos necesarios. Ponte en contacto con tu manager!.');
        }

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Usuario no ha sido encontrado.']);
        }

        $user->delete();
        return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
    }
}
