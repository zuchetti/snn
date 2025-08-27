<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class MedicamentosController extends Controller
{
    //
    use conection;

    public function __construct(){
        if(!\Session::has('tableMedicament')) \Session::put('tableMedicament', array());
    }  


    public function getPresentacion(){
        $data = [];
        $url = $this->server2.'api/json_medicamentos_presentacion';
        $info = $this->getJson($url,json_encode($data));
        return json_encode($info);
    }

    //medicamentos
    public function medicamentos(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        //print_r(json_encode(session('usuario')));
        return view('gestionDatos/medicamentos/inicio');
    }

 
    //new medicament
    public function nuevoMedicamento(Request $request){ 
        $info = json_decode($this->getPresentacion());
        return view('gestionDatos/medicamentos/nuevo',['info'=>$info]);
    }
    

    public function editMedicamento(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idmedicamento'=>$request['idmedicamento']];
        $url = $this->server2.'api/get_medicamento_detalle';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);

        $presentacion = json_decode($this->getPresentacion());

        return view('gestionDatos/medicamentos/editMedicamento',['presentacion'=>$presentacion,'info'=>$info,'idmedicamento'=>$request['idmedicamento']]);
    }




    public function detalleGrupo(Request $request){
        return view('gestionDatos/medicamentos/detalleGrupo',['idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }


    public function agregaritemGrupo(Request $request){
        $medicamentos = json_decode($this->getMedicamentos($request,$request['idgrupo']));
        //print_r(json_encode($medicamentos));
        $request->session()->forget('tableMedicament');
        return view('gestionDatos/medicamentos/agregaritemGrupo',['medicamentos'=>$medicamentos,'idgrupo'=>$request['idgrupo'],'nombre'=>$request['nombre']]);
    }

    public function agregarMedicamentoGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idgrupo'=>$request['idgrupo'],'listamedicamentos'=>$request['listamedicamentos']];
        //print_r(json_encode($data));
        $url = $this->server2.'api/agregar_medicamentos_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    
    //getMedicamentos
    public function getMedicamentos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        $idgrupo = $request['idgrupo'];
        if(empty($query))$query = "";
        if(empty($idgrupo))$idgrupo = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query, 'idgrupo'=>$idgrupo];
        $url = $this->server2.'api/get_medicamentos';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }
    


    //getMedicamentosTable
    public function getMedicamentosGrupoTable(Request $request){
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
        $url = $this->server2.'api/get_medicamentos_tabla_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getMedicamentosTable
    public function getMedicamentosAllTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        $idgrupo = $request['idgrupo'];
        if(empty($query))$query = "";
        if(empty($idgrupo))$idgrupo = "";

        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'idgrupo'=>$idgrupo, 'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query];
        $url = $this->server2.'api/get_medicamentos_tabla_all';
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

    
    //getDetailGrupo
    public function getDetailGrupo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idgrupo'=>$request['idgrupo']];
        $url = $this->server2.'api/get_medicamentos_detalle_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    
    //createMedicamento
    public function createMedicamento(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'nombregrupo'=>$request['nombregrupo'],'listamedicamentos'=>$request['listamedicamentos']];
        $url = $this->server2.'api/crear_medicamentos_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

        
    //deleteMedicamento
    public function deleteMedicamento(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idgrupoitem'=>$request['idgrupoitem']];
        $url = $this->server2.'api/eliminar_medicamentos_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //editMedicamentoAll
    public function editMedicamentoAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idmedicamento'=>$request['idmedicamento'],'tipo'=>$request['tipo'],'cod_producto'=>$request['cod_producto'],
        'producto'=>$request['producto'],'presentacion'=>$request['presentacion'],'precio_costo1'=>$request['precio_costo1'],
        'precio_venta1'=>$request['precio_venta1'],'precio_venta2'=>$request['precio_venta2'],
        'precio_farmext'=>$request['precio_farmext'],
        'cant_presentacion'=>$request['cant_presentacion']];
        $url = $this->server2.'api/editar_medicamento_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    
    //aggMedicamentAll
    public function aggMedicamentAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'tipo'=>$request['tipo'],'cod_producto'=>$request['cod_producto'],'producto'=>$request['producto'],
        'presentacion'=>$request['presentacion'],'precio_costo1'=>$request['precio_costo1'],'precio_venta1'=>$request['precio_venta1'],'precio_venta2'=>$request['precio_venta2'],
        'precio_farmext'=>$request['precio_farmext'],'cant_presentacion'=>$request['cant_presentacion']];
         //print_r(json_encode($data));
         $url = $this->server2.'api/agregar_medicamentos_all';
         $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
         return json_encode($result);
    }

    //deleteMedicamentAll
    public function deleteMedicamentAll(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idmedicamento'=>$request['idmedicamento']];
        $url = $this->server2.'api/eliminar_medicamentos_all';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //nuevoGrupo
    public function nuevoGrupo(Request $request){
        $medicamentos = json_decode($this->getMedicamentos($request));
        //print_r(json_encode($medicamentos));
        $request->session()->forget('tableMedicament');
        return view('gestionDatos/medicamentos/nuevoGrupo',['medicamentos'=>$medicamentos]);
    }

    //addMedicament
    public function addMedicament (Request $request){
        $tableMedicament = \Session::get('tableMedicament');
        $medicamentos = json_decode($this->getMedicamentos($request));
        foreach($medicamentos->data as $item){
            
            if ($request['idmedicamento']==$item->idmedicamento){
                $tableMedicament[$item->idmedicamento]=$item;
            }
        }
        $tableMedicament[$request['idmedicamento']]->cantidad=$request['cantidad'];
        \Session::put('tableMedicament',$tableMedicament);
        return $tableMedicament;
    }


}
