<?php

namespace App\Http\Controllers\Sanna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class SegurosController extends Controller
{
    //
    use conection;

    //getTipoSeguroTable
    public function getTipoSeguroTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_tiposeguro_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteSeguro
    public function deleteSeguro(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idtiposeguro'=>$request['idtiposeguro']];
        $url = $this->server2.'api/eliminar_tiposeguro';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //editSeguro
    public function editSeguro(Request $request){
        return view('gestionDatos/seguros/editar',
        ['idtiposeguro'=>$request['idtiposeguro'],'seguro'=>$request['seguro']]);
    }

    //updateSeguro
    public function updateSeguro(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idtiposeguro'=>$request['idtiposeguro'],'seguro'=>$request['seguro']];
         $url = $this->server2.'api/editar_tiposeguro';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //addSeguro
    public function addSeguro(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'seguro'=>$request['seguro']];
         $url = $this->server2.'api/agregar_tiposeguro';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function seguros(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/seguros/inicio');
    }
    
}
