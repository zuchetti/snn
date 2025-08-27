<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 
use View;


class DashboardController extends Controller
{
    //
    use conection;
   

    public function getGraficas(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],
        'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/get_estadisticas_admin';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //dashboard
    public function dashboard(Request $request){
        $grafica = json_decode($this->getGraficas($request));
        //print_r(json_encode($grafica));
        return view('dashboard/inicio',['grafica'=>$grafica]);
    }


    //gestion de bd
    public function gestiondebasededatos(Request $request){
        $data=[];
        $url = $this->server2.'api/get_gestionbasedatos_resumen';
        $result=$this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return view('gestionDatos/inicio',['result'=>$result]);
    }

    //deleteGroup
    public function deleteGroup(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,
        'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'idgrupo'=>$request['idgrupo']];
        $url = $this->server2.'api/eliminar_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

}
