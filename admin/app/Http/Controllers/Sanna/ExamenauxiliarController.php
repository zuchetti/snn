<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class ExamenauxiliarController extends Controller
{
    //
    use conection;

    public function __construct(){
        if(!\Session::has('examenLab')) \Session::put('examenLab', array());
        if(!\Session::has('examenImagen')) \Session::put('examenImagen', array());

    }  



    public function examenauxiliar(Request $request){
        //print_r(json_encode(session('usuario')));
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/examenesauxiliares/inicio');
    }



    public function agregarExamenGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idgrupo'=>$request['idgrupo'],'idexamenauxiliar'=>$request['idexamenauxiliar']];
        $url = $this->server2.'api/agregar_examen_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);

        return json_encode($result);
    }

    //getMedicamentosTable
    public function getExamenauxiliarGrupoTabla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        $tipo = $request['tipo'];

        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];

        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
 
        if(isset($tipo))$tipo =$request['tipo'];

        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],
        'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'tipo'=>$tipo];
        $url = $this->server2.'api/get_examen_tabla_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);

    }

    //getDetailGrupo
    public function getDetalleGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idgrupo'=>$request['idgrupo']];
        $url = $this->server2.'api/get_examen_detalle_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }


    public function detalleGrupo(Request $request){
        return view('gestionDatos/examenesauxiliares/detalleGrupo',['idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }


    //deleteMedicamento
    public function deleteGrupoExamen(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idgrupoitem'=>$request['idgrupoitem']];
        $url = $this->server2.'api/eliminar_examen_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function getExamenesAllTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        $idgrupo = $request['idgrupo'];
        if(empty($query))$query = "";
         if(empty($idgrupo))$idgrupo = "";
 
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'idgrupo'=>$idgrupo,  'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'], 'tipo'=>$request['tipo'],'petxpag'=>$request['petxpag'],
        'query'=>$query];
        $url = $this->server2.'api/get_examen_tabla_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function deleteExamenAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idexamenauxiliar'=>$request['idexamenauxiliar']];
        $url = $this->server2.'api/eliminar_examen_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function editExamen(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idexamenauxiliar'=>$request['idexamenauxiliar']];
        $url = $this->server2.'api/examen_detalle';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);

        return view('gestionDatos/examenesauxiliares/editExamen',['info'=>$info,'idexamenauxiliar'=>$request['idexamenauxiliar']]);
    }


    public function editExamenAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';

        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idexamenauxiliar'=>$request['idexamenauxiliar'],'tipo'=>$request['tipo'],'precio'=>$request['precio'],
        'examen'=>$request['examen']];
        $url = $this->server2.'api/editar_examen_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDetailMedicamento
    public function getDetailMedicamento(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('idusuario'),'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idgrupo'=>$request['idgrupo']];
        $url = $this->server2.'api/get_detalle_grupo_medicamento';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    
    //new medicament
    public function nuevoExamen(Request $request){
        return view('gestionDatos/examenesauxiliares/nuevo');
    }

    //getExamenLab
    public function getExamenLab(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $idgrupo = $request['idgrupo'];
        if(empty($idgrupo))$idgrupo = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idgrupo'=>$idgrupo];
        //print_r(json_encode($data));
         $url = $this->server2.'api/get_examen_lab';
         $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
         return json_encode($result);
    }

    //getExamenI
    public function getExamenI(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $idgrupo = $request['idgrupo'];
        if(empty($idgrupo))$idgrupo = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query, 'idgrupo'=>$idgrupo];
        //print_r(json_encode($data));
         $url = $this->server2.'api/get_examen_img';
         $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
         return json_encode($result);
    }
    
    public function aggExamenAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'tipo'=>$request['tipo'],'precio'=>$request['precio'],
        'examen'=>$request['examen']];
        //print_r(json_encode($data));
         $url = $this->server2.'api/agregar_examen_all';
         $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
         return json_encode($result);
    }

    public function createExamenGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'nombregrupo'=>$request['nombregrupo'],'idexamenauxiliar'=>$request['idexamenauxiliar']];
        $url = $this->server2.'api/crear_examen_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //nuevoGrupoExamen
    public function nuevoGrupoExamen(Request $request){
        $getExamenLab = json_decode($this->getExamenLab($request));
        //print_r(json_encode($getExamenLab));
        $request->session()->forget('examenLab');
        return view('gestionDatos/examenesauxiliares/nuevoGrupo',['getExamenLab'=>$getExamenLab]);
    }

    
    //nuevoGrupoExamenI
    public function nuevoGrupoExamenI(Request $request){
        $getExamenI = json_decode($this->getExamenI($request));
        //print_r(json_encode($getExamenLab));
        $request->session()->forget('examenImagen');
        return view('gestionDatos/examenesauxiliares/nuevoGrupoExamenI',['getExamenI'=>$getExamenI]);
    }

    public function agregaritemGrupoExamen(Request $request){
        $getExamenLab = json_decode($this->getExamenLab($request));
        //print_r(json_encode($getExamenLab));
        $request->session()->forget('examenLab');
        return view('gestionDatos/examenesauxiliares/agregaritemGrupo',['getExamenLab'=>$getExamenLab,'idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }

    
    public function agregaritemGrupoExamenI(Request $request){
        $getExamenI = json_decode($this->getExamenI($request));
        //print_r(json_encode($getExamenLab));
        $request->session()->forget('examenImagen');
        return view('gestionDatos/examenesauxiliares/agregaritemGrupoExamenI',['getExamenI'=>$getExamenI,'idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }
    
    
    //addExamenLab
    public function addExamenLab (Request $request){
        $examenLab = \Session::get('examenLab');
        $getExamenLab = json_decode($this->getExamenLab($request,$request['idgrupo']));
        $array = $request['idexamenauxiliar'];
    
        foreach($getExamenLab->data as $item){
            if (in_array($item->idexamenauxiliar, $array)){
                $examenLab[$item->idexamenauxiliar]=$item;
            }
        }
        \Session::put('examenLab',$examenLab);
        return $examenLab;
    }

    //addExamenImagen
    public function addExamenImagen(Request $request){
        $examenImagen = \Session::get('examenImagen');
        $getExamenI = json_decode($this->getExamenI($request,$request['idgrupo']));
        $array = $request['idexamenauxiliar'];
        foreach($getExamenI->data as $item){
            if (in_array($item->idexamenauxiliar, $array)){
                $examenImagen[$item->idexamenauxiliar]=$item;
            }
        }
        \Session::put('examenImagen',$examenImagen);
        return $examenImagen; 
    }




}
