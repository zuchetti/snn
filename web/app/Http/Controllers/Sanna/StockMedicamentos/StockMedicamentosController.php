<?php

namespace App\Http\Controllers\Sanna\StockMedicamentos;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class StockMedicamentosController extends Controller
{
    //
    use conection;

    //get_medicamento_topico_tabla
    public function getMedicTopicoTable(Request $request){
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
        $url = $this->server2.'api/get_medicamento_topico_tabla';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }


    //reposicionMedicamentos
    public function reposicionMedicamentosTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $estado = $request['estado'];
        if(empty($estado))$estado = "";
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,
        'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'estado'=>$request['estado'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'idtopico'=>session('topico')->idtopico];
        //print_r(json_encode($data));
        $url = $this->server2.'api/get_solicitudrepo';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }


    
    //stockActual
    public function stockActual(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
      
        $data=['so'=>2,'lat'=>$lat,
        'long'=>$long,
        'pag'=>$request['pag'],
        'petxpag'=>$request['petxpag'],
        'query'=>$request['query'],
        'idtopico'=>session('topico')->idtopico];
        // exit(json_encode(session('medico')->data[0]->token));
        $url = $this->server2.'api/get_stockactual';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getSolicitudrepodetail
    public function getSolicitudrepodetail(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,
        'so'=>2,'lat'=>$lat,'long'=>$long,'idreposicionh'=>$request['idreposicionh'],
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag']];
        $url = $this->server2.'api/get_solicitudrepo_detalle';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //resposicionDetail
    public function resposicionDetail(Request $request){
        return view('stockMedicamentos/detalleReposicion',['idreposicionh'=>$request['idreposicionh']]);
    }
     
    //nuevaSolicitud
    public function nuevaSolicitud(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,
        'so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,
        'repodetalle'=>$request['repodetalle']];
        $url = $this->server2.'api/nueva_solicitudrepo';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }




 

 

    


}
