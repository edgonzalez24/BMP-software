<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendInvitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class RolePermissionController extends Controller
{
    // Envía invitación por correo
    public function send_invitation(Request $request)
    {
        // Validando permiso
        if ( ! Auth::user()->can('send_invitation')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        // Validando data
        $validando = \Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users',
            'role_id' => 'required|integer',
        ]);

        if ($validando->fails())
        {
            return redirect()->back()->withErrors($validando->errors());
        }

        // Creando usuario y asignando rol
        $password = Str::random(8);
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($password),
        ]);
        $user->save();
        $user->assignRole($request->role_id);
        
        // Enviando credenciales por correo
        $url = env('APP_URL').'/login';
        $data = ['url' => $url, 'email' => $user->email, 'password' => $password];
        Mail::to($user->email)->send(new SendInvitation($data));

        return redirect()->back()->with('success', 'La invitación ha sido enviada exitosamente.');
    }
}
