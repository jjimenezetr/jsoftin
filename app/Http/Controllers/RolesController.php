<?php

namespace App\Http\Controllers;

use App\Role;
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
    	return view ('listar_rol',compact('roles'));
    }

}
