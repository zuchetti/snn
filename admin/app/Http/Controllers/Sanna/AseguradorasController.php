<?php

namespace App\Http\Controllers\Sanna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class AseguradorasController extends Controller
{
    //
    use conection;

    //getClientesTable
    public function getAseguradorasTable(Request $request){
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
        $url = $this->server2.'api/get_aseguradoras_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //addAseguradora
    public function addAseguradora(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'aseguradora'=>$request['aseguradora']];
         $url = $this->server2.'api/agregar_aseguradora';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteAseguradora
    public function deleteAseguradora(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idaseguradora'=>$request['idaseguradora']];
        $url = $this->server2.'api/eliminar_aseguradora';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //editAseguradora
    public function editAseguradora(Request $request){
        return view('gestionDatos/aseguradoras/editar',
        ['idaseguradora'=>$request['idaseguradora'],'aseguradora'=>$request['aseguradora']]);
    }

    //updateAseguradora
    public function updateAseguradora(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idaseguradora'=>$request['idaseguradora'],'aseguradora'=>$request['aseguradora']];
         $url = $this->server2.'api/editar_aseguradora';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function aseguradoras(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/aseguradoras/inicio');

    }


}
