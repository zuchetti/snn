<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class UserController extends Controller
{
    use conection;

    public function usuario(Request $request){
        $idfuncionalidad = $request['idfuncionalidad'];
        session(['idfuncionalidad'=>$idfuncionalidad]);
        return view('usuario/usuarios');
    }

    public function crearusuario(Request $request){
      return view('usuario/createuser');
    }

    public function borrarusuario(Request $request){
        $id=$request['id'];
        $menu=session('menu');
                
        $data_info=["id"=>$id, "idfuncionalidad"=>session('idfuncionalidad')];
        $data = json_encode($data_info);
        $url = $this->server2.'api/borrar_user';
        $result = $this->getServices($url,$data,session('usuario')->data[0]->token);
       

         return view('usuario/usuarios');

    }
    public function editarusuario(Request $request){

	    $id=$request['id'];
	    $menu=session('menu');
	    $lat='-12.0431800';
        $long='-77.0282400';
	    $data_info=["idusuario"=>session('usuario')->data[0]->info[0]->idusuario,"so"=>2,"lat"=>$lat,"long"=>$long, "id"=>$id, "idfuncionalidad"=>session('idfuncionalidad')];
        $data = json_encode($data_info);
        $url = $this->server2.'api/detalle_user';
        $result = $this->getServices($url,$data,session('usuario')->data[0]->token);
        
        return view('usuario/edit',['info'=>$result]);

    }
    

    public function getUsers(Request $request){
        $pag=$request->pag;
        $tipo=$request->tipo;
        $petxpag=$request->petxpag;
        $param=$request->all();
        $query=json_encode($param);
        $query=json_decode($query)->query;
        $lat='-12.0431800';
        $long='-77.0282400';
      
        $data_info = ["idusuario"=>session('usuario')->data[0]->info[0]->idusuario,"so"=>2,"lat"=>$lat,"long"=>$long,"query"=>$query,"pag"=>$pag,"idfuncionalidad"=>session('idfuncionalidad'),"tipo"=>$tipo, "petxpag"=>$petxpag];
        $data = json_encode($data_info);
        $url = $this->server2.'api/get_users_admin';
        $result = $this->getServices($url,$data,session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function postcrearusuario(Request $request){
        $nombre = $request['nombre'];
        $apellidos = $request['apellidos'];
        $email = $request['email'];
        $dni = $request['dni'];
        $pass = $request['pass'];
        $idrol = $request['idrol'];
        $lat='-12.0431800';
        $long='-77.0282400';

        $data_info = ['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'dni' => $dni, 'pass' => $pass, 'idrol' => $idrol, "idfuncionalidad"=>session('idfuncionalidad')];
        $data=json_encode($data_info);
        $url = $this->server2.'api/crear_admin';
        $result = $this->getServices($url,$data,session('usuario')->data[0]->token);
        return json_encode($result);     
        //return $data;
    }

    public function postEditusuario(Request $request){
        $nombre = $request['nombre'];
        $apellidos = $request['apellidos'];
        $email = $request['email'];
        $dni = $request['dni'];
        $id = $request['id'];
        $idrol = $request['idrol'];
        $pass=$request['pass'];
        $hash=$request['hash'];
        $lat='-12.0431800';
        $long='-77.0282400';

        $data_info = ['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'dni' => $dni, 'id' => $id, 'idrol' => $idrol,'hash'=>$hash, 'password'=>$pass, 'idfuncionalidad'=>session('idfuncionalidad'), 'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $data=json_encode($data_info);
        $url = $this->server2.'api/edit_user_admin';
       
        $result = $this->getServices($url,$data,session('usuario')->data[0]->token);
        return json_encode($result);     
        //return $data;
    }



}
