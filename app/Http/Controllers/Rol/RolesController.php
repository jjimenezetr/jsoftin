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
      //return 'Registro de usuario';
       //$roles=Rol::all();
       //return view ('notes/list',compact('roles'));
    }
    public function listar_rol(){
    	
    	$roles=Role::all(); 

        //dd($roles);
        //return $roles; 
    	//return view (view:'listar_rol',compact(varname:'roles'));
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

}
