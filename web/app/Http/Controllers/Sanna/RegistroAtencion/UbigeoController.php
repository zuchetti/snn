<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class UbigeoController extends Controller
{
    //
    use conection;
    
    //getPais
    public function getPais(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_pais';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getProvincia
    public function getProvincia(Request $request,$iddepartamento=null){
        if(isset($request['idparent'])){ 
            $idparent=$request['idparent'];
        }else{
            $idparent=$iddepartamento;
        }
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idparent'=>$idparent];
         $url = $this->server2.'api/get_provincia';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getDistrito
    public function getDistrito(Request $request,$idprovincia=null){
        if(isset($request['idparent'])){ 
            $idparent=$request['idparent'];
        }else{
            $idparent=$idprovincia;
        }
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idparent'=>$idparent];
        $url = $this->server2.'api/get_distrito';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

}
