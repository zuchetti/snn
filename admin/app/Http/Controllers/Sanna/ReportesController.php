<?php

namespace App\Http\Controllers\Sanna;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class ReportesController extends Controller
{
    //
    use conection;

    public function getmodulos(Request $request){
        $idowner=1;
        $usuario=session('usuario')->data[0]->info[0]->idusuario;

        $data=json_decode('[
            
            {"id":1,"funcionalidad":"Medicamentos"},{"id":2,
            "funcionalidad":"Diagnosticos"},{"id":3,"funcionalidad":"Activos Fijos"},
            {"id":4,"funcionalidad":"Examenes Auxiliares"},
            {"id":5,"funcionalidad":"Personal Médico"},
            {"id":6,"funcionalidad":"Topicos"},
            {"id":7,"funcionalidad":"Atenciones"},
            {"id":8,"funcionalidad":"Reemplazos"},
            {"id":9,"funcionalidad":"Logs"},
            {"id":10,"funcionalidad":"Kardek Stock "}]');
        $menu= new \stdClass;
        $menu->status=200;
        $menu->data=$data;

        $obj = new \stdClass;
        $obj->page = 1;
        $obj->pages = 1;
        $obj->perpage = 10;
        $obj->total = 10;
        $obj->sort = "asc";
        $obj->field = "id";

        $menu->meta=$obj;
        
        return json_encode($menu);
    }
    
    public function getreporte(Request $request){
        set_time_limit(0);
        $idreporte=$request['id'];
        $usuario=session('usuario')->data[0]->info[0]->idusuario;

        $nombre=$request['nombre'];

        if($idreporte==1){//Medicamentos
            $result=$this->medicamentos($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif($idreporte==2){//Diagnosticos
            $result=$this->diagnosticos($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==3) {//ActivosFijos
            $result=$this->activosfijos($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==4) {//Examenes Auxiliares
            $result=$this->examenesauxiliares($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==5) {//Personal Mèdico
            $result=$this->personalmedico($request);
            //exit($result);
            $result=json_decode($result);
            foreach($result->data as $item){
                switch ($item->sexo) {                                    
                    case 0:
                        $item->sexo='Femenino';
                    break;
                    case 1:
                        $item->sexo='Masculino';
                    break;
                }

                switch ($item->asignacion_familiar) {                                    
                    case 0:
                        $item->asignacion_familiar='No';
                    break;
                    case 1:
                        $item->asignacion_familiar='Si';
                    break;
                }
            }
          
            $result->nombre=$nombre;
        }elseif ($idreporte==6) {//Topicos
            
            $result=$this->topicos($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==7) {//Atenciones
           
            $result=$this->atenciones($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==8) {//Reemplazos
            $result=$this->reemplazos($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==9) {//Logs
            $result=$this->logs($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==10) {//Logs
            $result=$this->kardexstock($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==11) {//Logs
            $result=$this->tableAtenciones($request);
            $result=json_decode($result);
            $result->nombre=$nombre;
        }elseif ($idreporte==12) {//Logs
            $result=$this->farmacias($request);

            //exit(json_encode($result));
            $result=json_decode($result);
            $result->nombre=$nombre;
        }       


        
        return json_encode($result);
    }


    public function farmacias(Request $request){
        $data=['anio'=>$request['anio'],'mes'=>$request['mes']];
        $url = $this->server2.'api/tabla_farmacias';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token); 
        return json_encode($result);
    }
    
    public function tableAtenciones(Request $request){
        $data=['anio'=>$request['anio'],'mes'=>$request['mes']];
        $url = $this->server2.'api/tabla_atenciones';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token); 

        return json_encode($result);
    }
    public function kardexstock(Request $request){
        
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/kardexstock_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function atenciones(Request $request){  
        set_time_limit(0);    
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        // exit(json_encode($data));
        $url = $this->server2.'api/atenciones_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function logs(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/logs_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function reemplazos(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/reemplazos_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }
    
    public function topicos(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/topicos_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function personalmedico(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/personamedico_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function medicamentos(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/medicamentos_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function diagnosticos(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/diagnosticos_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function examenesauxiliares(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/examenes_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }

    public function activosfijos(Request $request){      
        $fecha_fin = $request['fecha_fin'];
        $fecha_ini = $request['fecha_ini'];  
        $idusuario=session('usuario')->data[0]->info[0]->idusuario;
        $so=2;
        $lat=1;
        $long=1;

        $data=[ "fecha_ini"=>$fecha_ini, "fecha_fin"=>$fecha_fin, "idusuario"=>$idusuario, "so"=>$so, "lat"=>$lat, "long"=>$long];  
        $url = $this->server2.'api/activofijo_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
       //   $result=$data_info;
        return json_encode($result);
    }
}
