<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    //
    use conection;


    public function getTopicos(){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional, 'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/get_topicos_medico';
        $topicos = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return $topicos;
    }
    
    //getTopicos
    public function topico(Request $request){
        $request->session()->forget('topico');
        $topicos=$this->getTopicos();
        //print_r(json_encode($topicos));
        return view('dashboard/topico',['topicos'=>$topicos]);
    }

    //dashboard
    public function dashboard(Request $request){

        //print_r($request['idtopico']);
     
        if($request['idtopico']!=""){
            $topico=['idtopico'=>$request['idtopico'],'cod_cso'=>$request['cod_cso'],'nombre'=>$request['nombre']];
            $dataU = $object = json_decode(json_encode($topico), FALSE);
            $request->session()->put(['topico'=>$dataU]);
        }
        
        if(!isset(session('topico')->idtopico)){
            $topicos=$this->getTopicos();
            return view('dashboard/topico',['topicos'=>$topicos]);

        }else{
            //print_r($request['idtopico']);
            return view('dashboard/dashboard');

        }
     
    
    }




}
