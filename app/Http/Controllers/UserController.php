<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResources;
use App\Http\Resources\UserCollection;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {

        $users = new UserCollection(User::all());
        $roles = Role::all();
        return response()->json([
            'users' => $users,
            'roles' => $roles,
        ]);

        //return view('users.users-list', compact('users', 'roles'));
    }

    public function destroy(User $user)
    {
        if ( ! Auth::user()->can('user_destroy')){
            return redirect()->back()->with('warning', 'No posees los permisos necesarios. Ponte en contacto con tu manager!.');
        }

        if (!$user) {
            return view('pagues.404');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
    }
}
