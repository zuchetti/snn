<?php

namespace App\Http\Controllers\Sanna;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class BaseAtencionesController extends Controller
{
    //
    use conection;

     //getJsonDisposicion
     public function getJsonDisposicion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_deposicion';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }
    
    //getJsonOrina
    public function getJsonOrina(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_orina';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

    //getBaseatencionTabla
    public function getBaseatencionTabla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'idtopico'=>session('topico')->idtopico];
        $url = $this->server2.'api/get_baseatencion_tabla';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getBaseatencionTabla
    public function getdetailBaseA(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/get_base_atencion_idatencion';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getDiagnosticos
    public function getDiagnosticos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_diagnosticos';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }
    
    public function getSeguroTopico(){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,
        'idprofesional'=>session('medico')->data[0]->info[0]->idprofesional];
        $url = $this->server2.'api/get_seguro_topico';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }


    //detailBaseatencion
    public function detailBaseatencion(Request $request){
        $info = json_decode($this->getdetailBaseA($request,$request['idatencion']));
        $dispo=$this->getJsonDisposicion($request);
        $orina=$this->getJsonOrina($request);
        $dianostics = json_decode($this->getDiagnosticos($request));
        $tipos=json_decode($this->getSeguroTopico());
        //print_r(json_encode($info));
        return view('basedeAtenciones/detalle',['antenciones'=>$info,'dispo'=>$dispo,
        'dianostics'=>$dianostics,'tipos'=>$tipos,
        'orina'=>$orina]);
    }


}
