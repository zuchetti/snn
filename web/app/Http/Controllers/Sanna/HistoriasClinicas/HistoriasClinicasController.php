<?php

namespace App\Http\Controllers\Sanna\HistoriasClinicas;

use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class HistoriasClinicasController extends Controller
{
    //
    use conection;

    //getDiagnosticos
    public function getDiagnosticos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_diagnosticos';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }
  

    public function descargaHistoria(request $request){
        
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'dni'=>$request['dni']];
   
        $url = $this->server2.'api/get_all_historial';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }


    public function pdfOrdenGenerate(request $request){
        
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'dni'=>$request['dni']];
   
        $url = $this->server2.'api/get_all_historial';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getHistoriasClinicasTable
    public function getHistoriasClinicasTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],
        'idtopico'=>session('topico')->idtopico];
        $url = $this->server2.'api/get_historiasclinicas_tabla_medico';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //detalleHistoriaClinicaTable
    public function detalleHistoriaClinicaTable(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'dni'=>$request['dni']];
        $url = $this->server2.'api/get_historiasclinicas_detalle_medico';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }


    //pdfRecetaMedica
    public function pdfRecetaMedica(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/generar_receta_medica_pdf';
        $info = $this->getPdf($url,json_encode($data));
        return $info; 
    }

    //pdfExamen
    public function pdfExamen(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/generar_examenes_auxiliares_pdf';
        $info = $this->getPdf($url,json_encode($data));
        return json_encode($info);
    }

    //pdfDescanso
    public function pdfDescanso(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/descanso_medico_pdf';
        $info = $this->getPdf($url,json_encode($data));
        return json_encode($info);
    }

    //HistoryClinicDetail
    public function HistoryClinicDetail(Request $request){
        return view('historiasClinicas/detalle',['dni'=>$request['dni'],'nombre'=>$request['nombre']]);
    }

    //detalleaAtencion
    public function detalleaAtencion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=[];
        $url = $this->server2.'api/pdf_orden_receta?idatencion='.$request['idatencion'];
        $receta = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/get_historiasclinicas_detalle_atencion_medico';
        $info = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);

        
        // exit(json_encode(session('medico')->data[0]->token));
        $url = $this->server2.'api/pdf_orden_examen?idatencion='.$request['idatencion'];
        $examen = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);

        $url = $this->server2.'api/pdf_orden_descanso?idatencion='.$request['idatencion'];
        $descanso = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);

        $dianostics=json_decode($this->getDiagnosticos($request));

        // exit(json_encode($descanso));

        //$history = $this->server2.'api/descarga_hojaconsulta?idatencion='.$request['idatencion'];
        return view('historiasClinicas/detalleAtencion',['info'=>$info,'receta'=>$receta,'dianostics'=>$dianostics,
        'descanso'=>$descanso,'examen'=>$examen,'dni'=>$request['dni'],'nombre'=>$request['nombre']]);
    }




    

}
