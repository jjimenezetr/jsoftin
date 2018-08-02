<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->middleware('auth');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'usuario' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function lista_usuario(){

        $usuarios = DB::table('users')->join('roles', 'users.id_rol', '=', 'roles.id')->paginate(5);
        //$usuarios = DB::table('users')->get();
        /*$usuarios = DB::table('users')->join('rol', 
                function($join) {
                    $join->on('users.id_rol', '=', 'rol.id')->where('rol.id', '!=', 0);
                })->get();*/

        //$usuarios=User::all(); 

        return view ('auth/lista_usuario',compact('usuarios'));
    }
    protected function form_usuario (){

        return view ('auth/form_usuario');
    }

    protected function nuevo_usuario (Request $request){

        /*$usuario=new User();
        $usuario->usuario=$request->usuario;
        $usuario->password=Hash::make($data['contrasena']);
        $usuario->email=$request->email;
        $usuario->id_rol=2;
        $usuario->save();*/
        $usuario=new User();
        $usuario->usuario='juanes';
        $usuario->password=Hash::make('123456789');
        $usuario->email='propioooo@gmail.com';
        $usuario->id_rol=2;
        $usuario->save();

        return view ('auth/form_usuario');
    }

    protected function create(array $data)
    {
        return User::create([
            'usuario' => $data['usuario'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_rol' => 1,
        ]);
    }

    /*protected function showRegistrationForm()
    {
        return redirect()->to('login')->with('warning', 'El registro de usuarios está desactivado');
    }*/

}
