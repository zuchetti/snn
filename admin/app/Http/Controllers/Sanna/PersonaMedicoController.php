<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class PersonaMedicoController extends Controller
{
    //

    use conection;

    public function editarHorarioPersonalmedico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idprofesional=$request['idprofesional'];
        $horario=$request['horario'];
        $eliminados=$request['eliminados'];
       

        $data=['idprofesional'=>$idprofesional,'horario'=>$horario,'eliminados'=>$eliminados, 'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        
        $url = $this->server2.'api/editar_personalmedico_horariov2';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  json_encode($calendario);

    }

    public function personalMedicoInicio(Request $request){   
        $planilla = json_decode($this->getPlanilla($request));
        $tipoProfesional = json_decode($this->getTipoProfesional($request));
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/personalMedico/inicio',['tipoProfesional'=>$tipoProfesional,'planilla'=>$planilla]);
    }

    public function calendario(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idprofesional=$request['idprofesional'];

       
        //$planilla = json_decode($this->getPlanilla($request));
        $data=['idprofesional'=>$idprofesional,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/get_personalmedico_horario';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return view('gestionDatos/personalMedico/calendario_horariomedico',['idprofesional'=>$idprofesional, 'calendario'=>$calendario]);

    }

    //getPlanilla
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

    //getTipoProfesional
    public function getTipoProfesional(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_tipo_pofesional';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }

    //getPersonalMedicoTable

    public function getPersonalMedicoTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'tipo_planilla'=>$request['tipo_planilla'],'tipo_profesional'=>$request['tipo_profesional']];
        $url = $this->server2.'api/get_personalmedico_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getPersonalMedico
    public function getPersonalMedico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idprofesional'=>$request['idprofesional']];
        $url = $this->server2.'api/get_personalmedico_detalle';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }

    //detallePersonalMedico
    public function detallePersonalMedico(Request $request){
        $info = json_decode($this->getPersonalMedico($request,$request['idprofesional']));
        //print_r(json_encode($info));
        return view('gestionDatos/personalMedico/detalle',['nombre'=>$request['nombre'],'info'=>$info,'idprofesional'=>$request['idprofesional']]);
    }

    //editPersonalMedico
    public function editPersonalMedico(Request $request){
        $info = json_decode($this->getPersonalMedico($request,$request['idprofesional']));
        $planilla = json_decode($this->getPlanilla($request));
        $tipoProfesional = json_decode($this->getTipoProfesional($request));
        return view('gestionDatos/personalMedico/editar',['tipoProfesional'=>$tipoProfesional,
        'planilla'=>$planilla,'nombre'=>$request['nombre'],'info'=>$info,'idprofesional'=>$request['idprofesional']]);
    }

    
    //deletePersonalMedico
    public function deletePersonalMedico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idprofesional'=>$request['idprofesional']];
        $url = $this->server2.'api/eliminar_personalmedico';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }


     //nuevoPersonalMedico
     public function nuevoPersonalMedico(Request $request){
        $planilla = json_decode($this->getPlanilla($request));
        $tipoProfesional = json_decode($this->getTipoProfesional($request));
        return view('gestionDatos/personalMedico/nuevo',['tipoProfesional'=>$tipoProfesional,'planilla'=>$planilla]);
    }

    //aggPersonalMedico
    public function aggPersonalMedico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';


     
        if($request->file('firmaDigital')!=""){
            $firma = $request->file('firmaDigital');
            $fileFirma = file_get_contents($firma);
            $base64Firma = base64_encode($fileFirma);
            $nameFirma = $_FILES['firmaDigital']['name'];
            $firmaDigital = ['filename'=>$nameFirma,'base64'=>$base64Firma];
           
        }else{
            $firmaDigital = ['filename'=>"",'base64'=>""];
        }

        if($request->file('selloDigital')!=""){
            $sello = $request->file('selloDigital');
            $fileSello = file_get_contents($sello);
            $base64Sello = base64_encode($fileSello);
            $nameSello = $_FILES['selloDigital']['name'];
            $selloDigital = ['filename'=>$nameSello,'base64'=>$base64Sello];
           
        }else{
            $selloDigital = ['filename'=>"",'base64'=>""];

        }
         $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'tipo_doc'=>$request['tipo_doc'],'num_doc'=>$request['num_doc'],'nombres'=>$request['nombres'],'ape_paterno'=>$request['ape_paterno'],
        'ape_materno'=>$request['ape_materno'],'sexo'=>$request['sexo'],'fec_nacimiento'=>$request['fec_nacimiento'],'tarifa'=>$request['tarifa'],
        'email'=>$request['email'],'telefono'=>$request['telefono'],'asignacion_familiar'=>$request['asignacion_familiar'],
        'idtipoprofesional'=>$request['idtipoprofesional'],'cod_rns'=>$request['cod_rns'],'cod_overall'=>$request['cod_overall'],'fec_ingplanilla'=>$request['fec_ingplanilla'],
        'idtipoplanilla'=>$request['idtipoplanilla'],'firma'=>$firmaDigital,'sello'=>$selloDigital,'password'=>$request['password']];
    
        //  exit(json_encode($data));
        $url = $this->server2.'api/agregar_personalmedico_nuevo';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info); 
    }

    //aggPersonalMedico
    public function updatePersonalMedico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        
        if($request['firmaDigital']!=""){
            $firma = $request->file('firmaDigital');
            $fileFirma = file_get_contents($firma);
            $base64Firma = base64_encode($fileFirma);
            $nameFirma = $_FILES['firmaDigital']['name'];
            $firmaDigital = ['filename'=>$nameFirma,'base64'=>$base64Firma];
           
        }else{
            $firmaDigital = "";
        }
        if($request['selloDigital']!=""){
            $sello = $request->file('selloDigital');
            $fileSello = file_get_contents($sello);
            $base64Sello = base64_encode($fileSello);
            $nameSello = $_FILES['selloDigital']['name'];
            $selloDigital = ['filename'=>$nameSello,'base64'=>$base64Sello];
           
        }else{
            $selloDigital = "";
        }

        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idprofesional'=>$request['idprofesional'],'tipo_doc'=>$request['tipo_doc'],'num_doc'=>$request['num_doc'],'nombres'=>$request['nombres'],'ape_paterno'=>$request['ape_paterno'],
        'ape_materno'=>$request['ape_materno'],'sexo'=>$request['sexo'],'fec_nacimiento'=>$request['fec_nacimiento'],'tarifa'=>$request['tarifa'],
        'email'=>$request['email'],'telefono'=>$request['telefono'],'asignacion_familiar'=>$request['asignacion_familiar'],
        'idtipoprofesional'=>$request['idtipoprofesional'],'cod_rns'=>$request['cod_rns'],'cod_overall'=>$request['cod_overall'],'fec_ingplanilla'=>$request['fec_ingplanilla'],
        'idtipoplanilla'=>$request['idtipoplanilla'],'firma'=>$firmaDigital,'sello'=>$selloDigital];
        //exit(json_encode($data));
        $url = $this->server2.'api/editar_personalmedico';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }

    
    //deletePersonalMedico
    public function validacion_eliminar_horario(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idprofesional'=>$request['idprofesional']];
        $url = $this->server2.'api/validacion_eliminar_horario';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($info);
    }





}
