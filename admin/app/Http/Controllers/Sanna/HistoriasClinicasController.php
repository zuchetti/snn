<?php


namespace App\Http\Controllers\Sanna;

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
    

    public function descargaHistoria(request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,
        'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],
        'dni'=>$request['dni'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario];
        
        $url = $this->server2.'api/atenciones_afiliado_reporte';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
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
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_historiasclinicas_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
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
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],'dni'=>$request['dni']];
        $url = $this->server2.'api/get_historiasclinicas_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //detalleHistoriasClinicas
    public function detalleHistoriaClinica(Request $request){

        return view('historiasClinicas/detalle',['dni'=>$request['dni'],'nombre'=>$request['nombre']]);
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

    ///pdfAtencion
    public function pdfAtencion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,
        'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],
        'dni'=>$request['dni'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'idatencion'=>$request['idatencion']];
      
        $url = $this->server2.'api/pdf_consolidado_atencion';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        
        return json_encode($result);
    }

    public function pdfFormatofiliacion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,
        'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],
        'dni'=>$request['dni'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/pdf_formato_filiacion';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function pdfHojaConsulta(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,
        'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin'],
        'dni'=>$request['dni'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/pdf_hojaconsulta';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }
    
    //detalleaAtencion
    public function detalleaAtencion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $datapdf=[];

        
        
        
       
        $filiacion = json_decode($this->pdfAtencion($request));
        $atencion = json_decode($this->pdfAtencion($request));
        
        $consulta = json_decode($this->pdfHojaConsulta($request));

       

       

        

        
        $urle = $this->server2.'api/pdf_orden_examen?idatencion='.$request['idatencion'];
        $examen = $this->getServices($urle,json_encode($datapdf),session('usuario')->data[0]->token);
        
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idatencion'=>$request['idatencion']];
        $url = $this->server2.'api/get_historiasclinicas_detalle_atencion';
        $info = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);

        $urld = $this->server2.'api/pdf_orden_descanso?idatencion='.$request['idatencion'];
        $descanso = $this->getServices($urld,json_encode($datapdf),session('usuario')->data[0]->token);

        $urlr = $this->server2.'api/pdf_orden_receta?idatencion='.$request['idatencion'];
        $receta = $this->getServices($urlr,json_encode($datapdf),session('usuario')->data[0]->token);

        



      
        
       

        $history = $this->server2.'api/descarga_hojaconsulta?idatencion='.$request['idatencion'];

        
        


        return view('historiasClinicas/detalleAtencion',['history'=>$history,
        'info'=>$info,'receta'=>$receta,'examen'=>$examen,'descanso'=>$descanso,
        'atencion'=>$atencion,'filiacion'=>$filiacion,'consulta'=>$consulta,'idatencion'=>$request['idatencion']]);
    }


    public function pdfSiteds(Request $request){
        $datapdf=[];
        $urlpdf = $this->server2.'api/pdf_siteds?idatencion='.$request['idatencion'];
        $pdfsiteds = $this->getServices($urlpdf,json_encode($datapdf),session('usuario')->data[0]->token);
        
        return response(base64_decode($pdfsiteds->data[0]->response_siteds->Documento))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename=nombre_archivo.pdf');
    }

    


}
