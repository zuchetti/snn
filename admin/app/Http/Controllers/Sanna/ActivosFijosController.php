<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class ActivosFijosController extends Controller
{
    //
    use conection;

    public function __construct(){
        if(!\Session::has('activosFijosAdd')) \Session::put('activosFijosAdd', array());


    }  

    //getTopicos
    public function getTopicos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,
        'idusuario'=>session('usuario')->data[0]->info[0]->idusuario];
        $url = $this->server2.'api/get_topicos_select';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //getActivosFijos
    public function getActivosFijos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $idgrupo = $request['idgrupo'];
        if(empty($idgrupo))$idgrupo = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idgrupo'=>$idgrupo];
        //print_r(json_encode($data));
        $url = $this->server2.'api/get_activosfijos';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }
 
    //detalleGrupo
    public function detalleGrupoActivosFijos(Request $request){
        return view('gestionDatos/activosFijos/detalleGrupo',['idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }

    //nuevoActivoFijo
    public function nuevoActivoFijo(Request $request){
        $topicos = json_decode($this->getTopicos($request));
        return view('gestionDatos/activosFijos/nuevo',['topicos'=>$topicos]);
    }

    public function agregarActivofijoGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idgrupo'=>$request['idgrupo'],'idactivofijo'=>$request['idactivofijo']];
        $url = $this->server2.'api/agregar_activosfijos_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);

        return json_encode($result);
    }

    //detalleGrupo
    public function editActivoFijo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'idactivofijo'=>$request['idactivofijo']];
        $url = $this->server2.'api/activofijo_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        $topicos = json_decode($this->getTopicos($request));
        //print_r(json_encode($topicos));
        return view('gestionDatos/activosFijos/editar',['topicos'=>$topicos,
            'info'=>$result,'idactivofijo'=>$request['idactivofijo']]);
    }

    //getActivosFijos
    public function getActivosFijosTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";

        $idgrupo = $request['idgrupo'];
         if(empty($idgrupo))$idgrupo = "";
         
         
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'idgrupo'=>$idgrupo,'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_activosfijos_tabla_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getActivosFijosTable
    public function getActivosFijosTableGrupo(Request $request){
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
        $url = $this->server2.'api/get_activosfijos_tabla_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getActivosFijosDetailGrupo
    public function getActivosFijosDetailGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idgrupo'=>$request['idgrupo']];
        $url = $this->server2.'api/get_activosfijos_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    
    //createGrupoActivoFijo
    public function createGrupoActivoFijo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'nombregrupo'=>$request['nombregrupo'],'idactivofijo'=>$request['idactivofijo']];
        $url = $this->server2.'api/crear_activosfijos_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteActivoFijo
    public function deleteActivoFijo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'idactivofijo'=>$request['idactivofijo']];
        $url = $this->server2.'api/eliminar_activoFijo_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //aggActivosFijos
    public function aggActivosFijos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico = $request['idtopico'];
        if(empty($idtopico))$idtopico = "";
        $cod_baja = $request['cod_baja'];
        if(empty($cod_baja))$cod_baja = "";

        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'marca'=>$request['marca'],'modelo'=>$request['modelo'],'serie'=>$request['serie'],'cod_inventario'=>$request['cod_inventario'],
        'propiedad'=>$request['propiedad'],'precio'=>$request['precio'],'estado'=>$request['estado'],'nombre'=>$request['nombre'],
        'cod_baja'=>$cod_baja,'idtopico'=>$idtopico,'comprobante'=>$request['comprobante']];
        $url = $this->server2.'api/agregar_activosfijos_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //updateActivosFijos
    public function updateActivosFijos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico = $request['idtopico'];
        if(empty($idtopico))$idtopico = "";
        $cod_baja = $request['cod_baja'];
        if(empty($cod_baja))$cod_baja = "";
        $data=['idactivofijo'=>$request['idactivofijo'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'marca'=>$request['marca'],'modelo'=>$request['modelo'],'serie'=>$request['serie'],'cod_inventario'=>$request['cod_inventario'],
        'propiedad'=>$request['propiedad'],'precio'=>$request['precio'],'estado'=>$request['estado'],'nombre'=>$request['nombre'],
        'cod_baja'=>$cod_baja,'idtopico'=>$idtopico,'comprobante'=>$request['comprobante']];
        $url = $this->server2.'api/editar_activofijo_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);

    }


    //nuevoGrupoActivoFijo
    public function nuevoGrupoActivoFijo(Request $request){
        $activosFijos = json_decode($this->getActivosFijos($request));
        //print_r(json_encode($activosFijos));
        $request->session()->forget('activosFijosAdd');
        return view('gestionDatos/activosFijos/nuevoGrupo',['activosFijos'=>$activosFijos]);
    }

    //agregaritemGrupo
    public function agregaritemGrupo(Request $request){
        $activosFijos = json_decode($this->getActivosFijos($request,$request['idgrupo']));
        $request->session()->forget('activosFijosAdd');
        return view('gestionDatos/activosFijos/agregaritemGrupo',['activosFijos'=>$activosFijos,'idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }
    
    //addActivoFijo
    public function addActivoFijo(Request $request){
        $activosFijosAdd = \Session::get('activosFijosAdd');
        $activosFijos = json_decode($this->getActivosFijos($request));
        $array = $request['idactivofijo'];
        //print_r($array);
        foreach($activosFijos->data as $item){
            if (in_array($item->idactivofijo, $array)){
                $activosFijosAdd[$item->idactivofijo]=$item;
            }
        }
        \Session::put('activosFijosAdd',$activosFijosAdd);
        return $activosFijosAdd; 
    }

 
    //deleteActivoFijo
    public function deleteGrupoActivosFijos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 
        'so'=>2,'lat'=>$lat,'long'=>$long,'idgrupo'=>$request['idgrupo'],'idgrupoitem'=>$request['idgrupoitem']];
        $url = $this->server2.'api/eliminar_activosfijos_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    public function activosFijos(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/activosFijos/inicio');
    }


}
