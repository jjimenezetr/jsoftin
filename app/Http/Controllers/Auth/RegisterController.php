<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Role;
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
            'email' => 'required|string|email|max:255',
            //'email' => 'required|string|email|max:255|unique:users',
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

        //$usuarios = DB::table('users')->join('roles', 'users.id_rol', '=', 'roles.id')->select('*','users.id')->paginate(5);
        $usuarios= DB::select('SELECT us.id,us.usuario,us.email,us.password,r.rol,us.created_at FROM users us JOIN roles r ON r.id = us.id_rol ');
        //dd($usuarios);
        return view ('auth/lista_usuario',compact('usuarios'));
    }
    protected function form_usuario (){

        $error='';
        //$roles=Role::all(); 
        $roles = DB::table('roles')->get();

        $arrayParametros = array(
                           'error' => $error,
                           'usuario' => '',
                           'contrasena' => '',
                           'email'=> '',
                           'id_rol'=>'',
                           );

        return view ('auth/form_usuario',compact('roles'),$arrayParametros);
    }

    protected function nuevo_usuario (Request $request){

        $error='';
        try {
            
            //$ExisteUsuario= DB::select('SELECT * FROM users WHERE usuario = ?  OR email = ? ',[$request->usuario,$request->email]);
            $ExisteUsuario= DB::select('SELECT * FROM users WHERE usuario = ?  ',[$request->usuario]);
            //dd(count($ExisteUsuario));
            if(count($ExisteUsuario)>0){
                $error='El usuario ingresado ya esta registrado';
            }
            else{

                $ExisteUsuario= DB::select('SELECT * FROM users WHERE email = ?  ',[$request->email]);
                if(count($ExisteUsuario)>0){
                    $error='El correo ingresado ya esta registrado';
                }else{
                    $usuario=new User();
                    $usuario->usuario=$request->usuario;
                    $usuario->password=Hash::make($request->contrasena);
                    $usuario->email=$request->email;
                    $usuario->id_rol=$request->id_rol;
                    $usuario->save();
                    $error='registrado';
                }
            }
        }
        catch (Exception $err) {
        }

        $roles = DB::table('roles')->get();
        $arrayParametros = array(
                           'error' => $error,
                           'usuario' => $request->usuario,
                           'contrasena' => $request->contrasena,
                           'email' => $request->email,
                           'id_rol' => $request->id_rol,
                           );


        return view ('auth/form_usuario',compact('roles'),$arrayParametros);
    }
    public function editar_usuario ($id){

        //dd(decrypt($id));
        $users = DB::table('users as usu')->where('usu.id','=',decrypt($id))->get();
        //$users = DB::table('users as usu')->where('usu.id_rol', $id)->join('roles as r', 'usu.id_rol', '=', 'r.id')->get();        
        $roles = DB::table('roles')->get();
        //dd($users);
        $error='';
        $arrayParametros = array(
                           'error' => $error,
                           'id'=> $users[0]->id,
                           'usuario' => $users[0]->usuario,
                           'email' => $users[0]->email,
                           'contrasena' => $users[0]->password,
                           'id_rol' => $users[0]->id_rol,
                           );


        return view ('auth/editar_usuario',compact('roles'),$arrayParametros);
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
    protected function actualizar_usuario (Request $request,$id){

        $error='';
        try {   
            $ExisteUsuario= DB::select('SELECT * FROM users WHERE usuario = ?  AND  id != ? ',[$request->usuario,decrypt($id)]);
            //dd($request->contrasena);
            if(count($ExisteUsuario)>0){
                $error='El usuario ingresado ya esta registrado';
            }
            else{
                $ExisteUsuario= DB::select('SELECT * FROM users WHERE email = ?  AND  id != ? ',[$request->email,decrypt($id)]);
                if(count($ExisteUsuario)>0){
                    $error='El correo ingresado ya esta registrado';
                }
                else{
                    $ExisteUsuario= DB::update('UPDATE users SET usuario= ?,email=?,id_rol=? WHERE id=?',[$request->usuario,$request->email,$request->id_rol,decrypt($id)]);
                    $error='registrado';
                }
            }
        }
        catch (Exception $err) {
        }
        $roles = DB::table('roles')->get();
        $arrayParametros = array(
                           'id' => decrypt($id),
                           'error' => $error,
                           'usuario' => $request->usuario,
                           'contrasena' => '************************************************************',
                           'email' => $request->email,
                           'id_rol' => $request->id_rol,
                           );

        return view ('auth/editar_usuario',compact('roles'),$arrayParametros);
    }
    protected function eliminar_usuario ($id){
        
        //dd($id);
        $error ='';
        try {
            DB::delete('DELETE FROM users  WHERE id= ? ',[$id]);     
            $error='eliminado';  
        } catch (Exception $e) {        
        }

        return $error;
    }
    /*protected function showRegistrationForm()
    {
        return redirect()->to('login')->with('warning', 'El registro de usuarios está desactivado');
    }*/
}
