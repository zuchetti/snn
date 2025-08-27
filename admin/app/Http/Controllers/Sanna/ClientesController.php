<?php
namespace App\Http\Controllers\Sanna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class ClientesController extends Controller
{
    //
    use conection;

    protected $TopicoController;

    
    public function __construct(TopicoController $TopicoController)
    {
       $this->TopicoController = $TopicoController;
       if(!\Session::has('clienteTable')) \Session::put('clienteTable', array());
       if(!\Session::has('addSedeTable')) \Session::put('addSedeTable', array());

    }

     //getClientesTable
     public function getClientesTable(Request $request){
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
        $url = $this->server2.'api/get_empresas_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getClientesTableDetail
    public function getClientesTableDetail(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idempresa'=>$request['idempresa'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_empresa_detalle_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteEmpresa
    public function deleteEmpresa(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idempresa'=>$request['idempresa']];
        $url = $this->server2.'api/eliminar_empresa';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteSubcliente
    public function deleteSubcliente(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idsubcliente'=>$request['idsubcliente']];
        $url = $this->server2.'api/eliminar_subcliente';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //addEmpresa
    public function addEmpresa(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'empresa'=>$request['empresa'],'sedes'=>$request['sedes']];
         $url = $this->server2.'api/agregar_empresa';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //addSubcliente
    public function addSubcliente(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'subcliente'=>$request['subcliente'],'idempresa'=>$request['idempresa']];
         $url = $this->server2.'api/agregar_subcliente';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }



    //subcliente
    public function subcliente(Request $request){
        $empresa = json_decode($this->TopicoController->getEmpresas($request));
        //print_r(json_encode($empresa));
        return view('gestionDatos/clientes/subcliente',['empresa'=>$empresa]);
    }

    //updateInfoEmpresa
    public function updateInfoEmpresa(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idempresa'=>$request['idempresa'],'empresa'=>$request['empresa']];
         $url = $this->server2.'api/editar_empresa';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDetailEmpresa
    public function getDetailEmpresa($idempresa){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idempresa'=>$idempresa];
         $url = $this->server2.'api/get_empresa_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($data);
    }


    
    //editCliente
    public function editCliente(Request $request){

        return view('gestionDatos/clientes/editarCliente',
        ['idempresa'=>$request['idempresa'],'empresa'=>$request['empresa']]);
    }

    //nuevoCliente
    public function nuevoCliente(Request $request){
        $request->session()->forget('clienteTable');
        return view('gestionDatos/clientes/nuevo');
    }

    
    public function clienteTable(Request $request){
        $clienteTable = \Session::get('clienteTable');
        $sede = $request['sede'];
        $empresa = $request['empresa'];

        $clienteTable[]=array('sede'=>$sede,'empresa'=>$empresa);
        
        \Session::put('clienteTable',$clienteTable);
        return $clienteTable; 
    }

    public function detalleEmpresa(Request $request){
        return view('gestionDatos/clientes/detalle',['idempresa'=>$request['idempresa'],
            'empresa'=>$request['empresa']]);
    }
   
    //aggSucliente
    public function addSucliente(Request $request){
        //print_r(json_encode($infoEmpresa));
        $request->session()->forget('addSedeTable');
        return view('gestionDatos/clientes/addSucliente',
        ['idempresa'=>$request['idempresa'],'empresa'=>$request['empresa']]);
    }

    public function addSedeTable(Request $request){
        $addSedeTable = \Session::get('addSedeTable');
 
        $sede = $request['sede'];
        $empresa = $request['empresa'];


        $addSedeTable[]=array('sede'=>$sede,'empresa'=>$empresa);
            
        
        \Session::put('addSedeTable',$addSedeTable);
        return $addSedeTable; 
    }

    //saveSubcliente
    public function saveSubcliente(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'idempresa'=>$request['idempresa'],'sedes'=>$request['sedes']];
         $url = $this->server2.'api/agregar_subcliente';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function clientes(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/clientes/inicio');
    }



}
