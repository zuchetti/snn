<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class ProveedoresController extends Controller
{
    //
    use conection;

    public function getconceptopl(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_conceptopl';
        $info = $this->getServicesGET($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }

    //detalleProveedor
    public function detalleProveedor(Request $request){
        $info = json_decode($this->getDetailProveedor($request,$request['idproveedor']));
        return view('gestionDatos/proveedores/detalle',['info'=>$info,'idproveedor'=>$request['idproveedor'],'razon_social'=>$request['razon_social']]);
    }

    //detalleProveedor
    public function nuevoProveedor(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        $info = json_decode($this->getconceptopl($request));
        return view('gestionDatos/proveedores/nuevo',['info'=>$info]);
    }

    //editProveedor
    public function editProveedor(Request $request){
        $info = json_decode($this->getDetailProveedor($request,$request['idproveedor']));
        $concepto = json_decode($this->getconceptopl($request));

        return view('gestionDatos/proveedores/editar',['concepto'=>$concepto,'info'=>$info,'idproveedor'=>$request['idproveedor'],'razon_social'=>$request['razon_social']]);
    }

    public function getDetailProveedor(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idproveedor'=>$request['idproveedor']];
        $url = $this->server2.'api/get_proveedores_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }
    
    //getProveedoresTable
    public function getProveedoresTable(Request $request){
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
        $url = $this->server2.'api/get_proveedores_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //aggProveedor
    public function aggProveedor(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'ruc'=>$request['ruc'],'razon_social'=>$request['razon_social'],'contacto'=>$request['contacto'],
        'email_contacto'=>$request['email_contacto'],'telf_contacto'=>$request['telf_contacto'],'concepto_pl'=>$request['concepto_pl']];
         $url = $this->server2.'api/agregar_proveedor';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //updateProveedor
    public function updateProveedor(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idproveedor'=>$request['idproveedor'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'ruc'=>$request['ruc'],'razon_social'=>$request['razon_social'],'contacto'=>$request['contacto'],
        'email_contacto'=>$request['email_contacto'],'telf_contacto'=>$request['telf_contacto'],'concepto_pl'=>$request['concepto_pl']];
         $url = $this->server2.'api/editar_proveedor';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //deleteProveedor
    public function deleteProveedor(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'idproveedor'=>$request['idproveedor']];
        $url = $this->server2.'api/eliminar_proveedor';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function proveedores(Request $request){
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/proveedores/inicio');

    }


}
