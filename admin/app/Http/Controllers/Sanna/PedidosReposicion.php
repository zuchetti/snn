<?php

namespace App\Http\Controllers\Sanna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 
use Redirect;


class PedidosReposicion extends Controller
{
    //

 
    use conection;

    protected $TopicoController;
    public function __construct(TopicoController $TopicoController)
    {
       $this->TopicoController = $TopicoController;
    }


    public function descargapedido(Request $request){
        $idreposicionh=$request['idreposicionh'];
        $usuario=session('usuario')->data[0]->info[0]->idusuario;        
   
        $nombre="descargaSocicitud_".$idreposicionh;
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;
        $data=[ "idreposicionh"=>$idreposicionh,  "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/descarga_solicitudrepodetalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        $result->nombre=$nombre;
            
        return json_encode($result);
    }

    //getSolicitudReposicion
    public function getSolicitudReposicion(Request $request){
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
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'estado'=>$request['estado']];
        $url = $this->server2.'api/get_solicitudrepo_admin';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDetailPedido
    public function getDetailPedido(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],'idreposicionh'=>$request['idreposicionh']];
        $url = $this->server2.'api/get_solicitudrepo_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //pedidoDetail
    public function pedidoDetail(Request $request){
        return view('pedidos/detalle',
        ['idreposicionh'=>$request['idreposicionh'],'state'=>$request['state']]);
    }

    //getDetailPedido
    public function downloadMedicamentoreposicion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idtopico'=>$request['idtopico']];
        //exit(session('usuario')->data[0]->token);
        $url = $this->server2.'api/download_medicamentoreposicion';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //pedidoDetail2
    public function pedidoDetail2(Request $request){
        return view('pedidos/detalle2',
        ['idtopico'=>$request['idtopico'],'idreposicionh'=>$request['idreposicionh'],'state'=>$request['state']]);
    }

     


    public function updateStockBotiquinMasivo(Request $request){
      

        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
        
            $arrayto=[];
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $idbotiquinitem   = $line[0];
                $cod_producto  = $line[1];
                $producto  = $line[2];
                $tipo  = $line[3];
                $presentacion  = $line[4];
                $precio_costo1  = $line[5];
                $precio_venta1  = $line[6];
                $precio_venta2  = $line[7];
                $precio_farmext  = $line[8];
                $cant_presentacion  = $line[9];
                $cantidad  = $line[10];

                array_push($arrayto,array('idbotiquinitem'=>$idbotiquinitem,
                'cod_producto'=>$cod_producto,'producto'=>$producto,'tipo'=>$tipo,
                'presentacion'=>$presentacion,'precio_costo1'=>$precio_costo1,
                'precio_venta1'=>$precio_venta1,'precio_venta2'=>$precio_venta2,
                'precio_farmext'=>$precio_farmext,'cant_presentacion'=>$cant_presentacion,
                'cantidad'=>$cantidad));
               
            }

            // Close opened CSV file
            fclose($csvFile);
            $lat='-12.0431800';
            $long='-77.0282400';

            $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
            'idtopico'=>$request['idtopico'],'stockdetalle'=>$arrayto];
            //exit(json_encode($data));
            $url = $this->server2.'api/actualizar_stock_botiquin_masivo';
            $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
            return Redirect::back()->withErrors($result->message);

            //return json_encode($data);

        }
    }

    public function medicamentosTopico(Request $request){   
        $tipoProfesional = json_decode($this->TopicoController->getTipoProfesional($request));
        
        return view('pedidos/medicamentosTopico',['tipoProfesional'=>$tipoProfesional]);
    }   


    //medicTopicoDetail
    public function medicTopicoDetail(Request $request){   
        return view('pedidos/medicTopicoDetail',['idtopico'=>$request['idtopico']]);
    }   

    //medicTopicoDetail
    public function medicTopicoDetail2(Request $request){   
        return view('pedidos/medicTopicoDetail2',['idtopico'=>$request['idtopico']]);
    }   
    

    //aprobarSolicitud
    public function aprobarSolicitud(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'so'=>2,'lat'=>$lat,'long'=>$long,'idreposicionh'=>$request['idreposicionh'],
        'repodetalle'=>$request['repodetalle']];
        $url = $this->server2.'api/aprobar_solicitudrepo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //denegarSolicitud
    public function denegarSolicitud(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'so'=>2,'lat'=>$lat,'long'=>$long,'idreposicionh'=>$request['idreposicionh']];
        $url = $this->server2.'api/denegar_solicitudrepo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //updateStockBotiquin
    public function updateStockBotiquin(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'so'=>2,'lat'=>$lat,'long'=>$long,'stockdetalle'=>$request['stockdetalle']];
         $url = $this->server2.'api/actualizar_stock_botiquin';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }
    


}
