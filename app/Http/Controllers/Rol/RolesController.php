<?php

namespace App\Http\Controllers\Rol;

use App\Model\Role;
//use App\resources\view\listar.rol;

use Illuminate\Http\Request;

//use App\Http\Request;
use App\Http\Controllers\Controller;



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

        return view ('Rol/form_rol');
    }
    protected function nuevo_rol (Request $request){

        $rol=new Role();
        $rol->rol=$request->rol;
        $rol->save();

        return view ('Rol/form_rol');
    }
    protected function editar_rol ($id){
        
        //dd($id);
        $roles = Role::find($id);

        return view ('Rol/editar_rol',compact('roles'));
    }
    protected function actualizar_rol (Request $request, $id){

        $roles = Role::find($id);
        $roles->rol=$request->rol;
        $roles->save();

        $roles=Role::all(); 

        return view ('Rol/listar_rol',compact('roles'));

    }
    protected function eliminar_rol ($id){
        
        //dd($id);
        $roles = Role::find($id);
        $roles->delete();
        
        $roles=Role::all(); 

        return view ('Rol/listar_rol',compact('roles'));
    }

}
