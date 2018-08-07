<?php

namespace App\Http\Controllers\Rol;

use App\Model\Role;
//use App\resources\view\listar.rol;

use Illuminate\Http\Request;

//use App\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class RolesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

       //return view ('notes/list',compact('roles'));
    }
    public function listar_rol(){
    	
    	$roles=Role::all(); 

        //dd($roles);

    	return view ('Rol/listar_rol',compact('roles'));
    }
    protected function form_rol (){

        $arrayParametros = array(
                           'error' => '',
                           );

        return view ('Rol/form_rol',$arrayParametros);
    }
    protected function nuevo_rol (Request $request){

       //$roles=Role::all(); 
        $error='';
        try {
            $ExisteRol= DB::select('SELECT * FROM roles WHERE rol = ? ',[$request->rol]);
            //dd(count($ExisteRol));
            if(count($ExisteRol)>0){
                $error='duplicado';
            }
            else{
                $rol=new Role();
                $rol->rol=$request->rol;
                $rol->save(); 
                $error='registrado';
            }
        } 
        catch (Exception $err) {
            $error='Error!! verifique su conexión';
        }

        $arrayParametros = array(
                           'error' => $error,
                           );


        return view ('Rol/form_rol',$arrayParametros);
    }   
    protected function editar_rol ($id){
  
        $error='';
        //dd($id);
        $roles = Role::find(decrypt($id));

        $arrayParametros = array(
                           'error' => $error,
                           );

        return view ('Rol/editar_rol',compact('roles'),$arrayParametros);
    }
    protected function actualizar_rol (Request $request, $id){
        
        $error='';
        $ExisteRol= DB::select('SELECT * FROM roles WHERE rol = ? ',[$request->rol]);

        //dd(count($ExisteRol));
        if(count($ExisteRol)>0){
            $error='duplicado';
        }
        else{
            $roles = Role::find(decrypt($id));
            $roles->rol=$request->rol;
            $roles->save();
            $error='registrado';
        }   
        $roles = Role::find(decrypt($id));
        $arrayParametros = array(
                           'error' => $error,
                           'id' => encrypt($id),
                           );

        return view ('Rol/editar_rol',compact('roles'),$arrayParametros );
    }
    protected function eliminar_rol ($id){
        
        $eliminado='';
        $ExisteUsuario= DB::SELECT('SELECT * FROM  users  WHERE id_rol= ? ',[$id]);
        if(count($ExisteUsuario)>0){
            return "El rol seleccionado esta asociado a uno o varios usuario";
        }else{
            $roles = Role::find($id);
            $roles->delete();
        }

        return $eliminado;
    }
    public function getRol(){
        $roles=Role::all();
        return $roles;
        //return response()->json($roles);
    }

    /*protected function nuevo_usuario (Request $request){

        $usuario=new User();
        $usuario->usuario=$request->usuario;
        $usuario->password=Hash::make($request->contrasena);
        $usuario->email=$request->email;
        $usuario->id_rol=2;
        $usuario->save();

        return view ('auth/form_usuario');
    }*/

}

?>