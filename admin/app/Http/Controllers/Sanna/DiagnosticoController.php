<?php


namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class DiagnosticoController extends Controller
{
    //
    use conection;

    public function __construct(){
        if(!\Session::has('diganosticoGroup')) \Session::put('diganosticoGroup', array());
   }  


    //detalleGrupo
    public function detalleGrupoDiagnostico(Request $request){
        
        return view('gestionDatos/diagnostico/detalleGrupo',['idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }

    //editDiagnostico
    public function editDiagnostico(Request $request){

        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'iddiagnostico'=>$request['iddiagnostico']];
        $url = $this->server2.'api/diagnostico_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return view('gestionDatos/diagnostico/editar',['info'=>$result,'iddiagnostico'=>$request['iddiagnostico'],'diagnostico'=>$request['diagnostico']]);
    }


    //agregarDiagnosticoGrupo
    public function agregarDiagnosticoGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idgrupo'=>$request['idgrupo'],'iddiagnostico'=>$request['iddiagnostico']];
        $url = $this->server2.'api/agregar_diagnostico_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //getDiagnosticoAllTable
    public function getDiagnosticoAllTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $idgrupo = $request['idgrupo'];
         if(empty($idgrupo))$idgrupo = "";
         
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'idgrupo'=>$idgrupo, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'query'=>$query];
        $url = $this->server2.'api/get_diagnostico_tabla_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDiagnosticoTable
    public function getDiagnosticoGrupoTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_diagnosticos_tabla_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDiagnosticoGrupoDetailTable
    public function getDiagnosticoGrupoDetailTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idgrupo'=>$request['idgrupo']];
        $url = $this->server2.'api/get_diagnosticos_detalle_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteDiagnosticoGrupo
    public function deleteDiagnosticoGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idgrupoitem'=>$request['idgrupoitem']];
        $url = $this->server2.'api/eliminar_diagnostico_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //aggDiagnostico
    public function aggDiagnostico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'diagnostico'=>$request['diagnostico'],'cie10'=>$request['cie10']];
        $url = $this->server2.'api/agregar_diagnostico_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //createGrupoDiagnostico
    public function createGrupoDiagnostico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'nombregrupo'=>$request['nombregrupo'],'iddiagnostico'=>$request['iddiagnostico']];
        $url = $this->server2.'api/crear_diagnostico_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteDiagnosticoAll
    public function deleteDiagnosticoAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'iddiagnostico'=>$request['iddiagnostico']];
        $url = $this->server2.'api/eliminar_diagnostico_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //updateDiagnosticoAll
    public function updateDiagnosticoAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'iddiagnostico'=>$request['iddiagnostico'],'diagnostico'=>$request['diagnostico'],'cie10'=>$request['cie10']];
        $url = $this->server2.'api/editar_diagnostico_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDiagnosticos
    public function getDiagnosticos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $idgrupo = $request['idgrupo'];
        if(empty($idgrupo))$idgrupo = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idgrupo'=>$idgrupo];
        $url = $this->server2.'api/get_diagnosticos';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //nuevoGrupoDiagnostico
    public function nuevoGrupoDiagnostico(Request $request){
        $diagnosticos = json_decode($this->getDiagnosticos($request));
     
        $request->session()->forget('diganosticoGroup');
        return view('gestionDatos/diagnostico/nuevoGrupo',['diagnosticos'=>$diagnosticos]);
    }

    //agregaritemGrupo
    public function agregaritemGrupo(Request $request){
        $diagnosticos = json_decode($this->getDiagnosticos($request,$request['idgrupo']));
        $request->session()->forget('diganosticoGroup');
        return view('gestionDatos/diagnostico/agregaritemGrupo',['diagnosticos'=>$diagnosticos,'idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }

    //addDiagnostico
    public function addDiagnostico(Request $request){
        $diganosticoGroup = \Session::get('diganosticoGroup');
        $diagnosticos = json_decode($this->getDiagnosticos($request));
        $array = $request['iddiagnostico'];

        foreach($diagnosticos->data as $item){
            if (in_array($item->iddiagnostico, $array)){
                $diganosticoGroup[$item->iddiagnostico]=$item;
            }
        }
        \Session::put('diganosticoGroup',$diganosticoGroup);
        return $diganosticoGroup; 
    }


    public function diagnostico(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/diagnostico/inicio');

    }


}
