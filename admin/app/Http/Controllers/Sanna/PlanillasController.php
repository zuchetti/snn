<?php
namespace App\Http\Controllers\Sanna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class PlanillasController extends Controller
{
    //
    use conection;

    //getClientesTable
    public function getPlanillasTable(Request $request){
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
        $url = $this->server2.'api/get_tipoplanilla_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

     //addPlanilla
     public function addPlanilla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'planilla'=>$request['planilla']];
         $url = $this->server2.'api/agregar_tipoplanilla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //deletePlanilla
    public function deletePlanilla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idtipoplanilla'=>$request['idtipoplanilla']];
        $url = $this->server2.'api/eliminar_tipoplanilla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //editPlanilla
    public function editPlanilla(Request $request){
        return view('gestionDatos/planillas/editar',
        ['idtipoplanilla'=>$request['idtipoplanilla'],'planilla'=>$request['planilla']]);
    }

    //updatePlanilla
    public function updatePlanilla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idtipoplanilla'=>$request['idtipoplanilla'],'planilla'=>$request['planilla']];
         $url = $this->server2.'api/editar_tipoplanilla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    
    public function planillas(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/planillas/inicio');
    }

    

}
