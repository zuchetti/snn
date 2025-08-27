<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use DateTime;
use App\Providers\conection; 

class ProgramacionMedica extends Controller
{
    //
    use conection;

    //getProgramacionMedicaTable
    
    public function editarHorarioProgramacionmedica(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico=$request['idtopico'];
        $horario=$request['horario'];
        $eliminados=$request['eliminados'];
       

        $data=['idtopico'=>$idtopico,'horario'=>$horario,'eliminados'=>$eliminados, 'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        
        $url = $this->server2.'api/editar_programacionmedica_calendario';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  json_encode($calendario);

    }


    public function getProgramacionMedicaTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];

        $data=['estado'=>$request['estado'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_programacion_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //calendario
    public function calendario(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico=$request['idtopico'];
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $planilla = json_decode($this->getPlanilla($request));
        $data=['fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'idtopico'=>$idtopico,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/get_programacion_medica_calendario';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        // exit(json_encode($calendario));

        $data=['idtopico'=>$idtopico,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/topico_especialidades';
        $especialidades =$this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        $especialidades=$especialidades->data;

        if(empty($fecha_ini)) $fecha_ini=(new DateTime())->format('Y-m-d');
 
        $messig= ((new DateTime())->modify( 'first day of previous month' ))->format('m');

        $messig=$this->mes($messig);

        return view('programacionMedica/calendario',['messig'=>$messig, 'idtopico'=>$idtopico,'fecha_ini'=>$fecha_ini, 'especialidades'=>$especialidades,'planilla'=>$planilla,'calendario'=>$calendario]);

    }

    public function mes($mes){
        switch($mes){
            case 1:
                $mes= "Enero";
                break;
            case 2:
                $mes= "Febrero";
                break;
            case 3:
                $mes= "Marzo";
                break;
            case 4:
                $mes= "Abril";
                break;
            case 5:
                $mes= "Mayo";
                break;
            case 6:
                $mes= "Junio";
                break;
            case 7:
                $mes= "Julio";
                break;
            case 8:
                $mes= "Agosto";
                break;
            case 9:
                $mes= "Septiembre";
                break;
            case 10:
                $mes= "Octubre";
                break;
            case 11:
                $mes= "Noviembre";
                break;
            case 12:
                $mes= "Diciembre";
                break;

        }

        return $mes;
    }

    public function repetirProgramacion(Request $request){
        $mes_origen=$request['mes_origen'];
        $anio_destino=$request['anio_destino'];
        $mes_destino=$request['mes_destino'];
        $anio_origen=$request['anio_origen'];
        $idtopico=$request['idtopico'];
        $fecha_origen=$anio_origen.'-'.$mes_origen.'-01';
        $fecha_destino=$anio_destino.'-'.$mes_destino.'-01';
        $lat='-12.0431800';
        $long='-77.0282400';

        $data=['idtopico'=>$idtopico,'fecha_add'=>$fecha_destino,'fecharepetir'=>$fecha_origen,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        
        $url = $this->server2.'api/repetir_programacion_medica_mes';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);

    }

    public function getPlanilla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_tipo_planilla';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }

    public function agregarProgramacionmedica(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico=$request['idtopico'];
        $hora_ini=$request['hora_ini'];
        $hora_fin=$request['hora_fin'];
        $idprofesional=$request['idprofesional'];
        $fecha=$request['fecha'];

        $data=['idprofesional'=>$idprofesional,'dia'=>$fecha,'hora_ini'=>$hora_ini,'hora_fin'=>$hora_fin,'idtopico'=>$idtopico,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/agregar_programacionmedica';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  json_encode($calendario);

    }

    public function reemplazarProgramacionmedica(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idprogramacionmedica=$request['idprogramacionmedica'];
        $motivo=$request['motivo'];
        $idplanilla=$request['idplanilla'];
        $idprofesional_actual=$request['idprofesional_actual'];
        $idprofesional_reemplazo=$request['idprofesional_reemplazo'];
        $comentario=$request['comentario'];

        $data=['idprogramacionmedica'=>$idprogramacionmedica,'motivo'=>$motivo,'comentario'=>$comentario,'idplanilla'=>$idplanilla,'idprofesional_actual'=>$idprofesional_actual,'idprofesional_reemplazo'=>$idprofesional_reemplazo,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/reemplazo_programacionmedica';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  json_encode($calendario);

    }


    public function getProfesionalesDispo(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'fecha'=>$request['fecha'],'idtipoprofesional'=>$request['idtipoprofesional'],'hora_ini'=>$request['hora_ini'],'hora_fin'=>$request['hora_fin'],'query'=>$request['query']];
        $url = $this->server2.'api/get_profesionalesdisponiblesv2';
        $response = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  json_encode($response);
    }


}
