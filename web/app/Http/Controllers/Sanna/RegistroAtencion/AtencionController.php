<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 
use Illuminate\Support\Facades\View;

class AtencionController extends Controller
{
    //
    use conection;

    protected $DiagnosticoController;
    protected $RecetaMedicaController;
    protected $UbigeoController;
    protected $HistoriaClinicaController;

    public function __construct(DiagnosticoController $DiagnosticoController,
    HistoriaClinicaController $HistoriaClinicaController,UbigeoController $UbigeoController,
    RegistroAtencionController $RegistroAtencionController)
    {
       $this->DiagnosticoController = $DiagnosticoController;
       $this->HistoriaClinicaController = $HistoriaClinicaController;
       $this->UbigeoController = $UbigeoController;
    }


    //filiacion
    public function filiacion(Request $request){
        $datos=session('filiacion');
        //$request->session()->forget('finalizar');
        //print_r(json_encode(session('medico')));
        $tipos=json_decode($this->HistoriaClinicaController->getSeguroTopico());

        return view('registroAtencion/atencion/filiacion',['datos'=>$datos,'tipos'=>$tipos]);
    }

    //atencion
    public function atencion(Request $request){
        $datos=session('diagnostico');
        $dispo=$this->DiagnosticoController->getJsonDisposicion($request);
        $orina=$this->DiagnosticoController->getJsonOrina($request);
        $examenes=session('examenes');
        $tipos=json_decode($this->HistoriaClinicaController->getSeguroTopico());
        $afiliacion=session('filiacion');

        //$request->session()->forget('finalizar');
        //print_r(json_encode($afiliacion));
        $dianostics=json_decode($this->DiagnosticoController->getDiagnosticos($request));
        return view('registroAtencion/atencion/atencion',['datos'=>$datos,'orina'=>$orina,'dianostics'=>$dianostics,
        'dispo'=>$dispo,'examenes'=>$examenes,'tipos'=>$tipos,'afiliacion'=>$afiliacion]);
    }

    //receta
    public function receta(Request $request){
        $datos=session('receta');
        $tipos=json_decode($this->HistoriaClinicaController->getSeguroTopico());
        $pais=json_decode($this->UbigeoController->getPais($request));
        $pdf=$this->recetaPDF();
        //print_r(json_encode($pdf));
        //print_r(json_encode($pdf));
        if($datos->delivery==1){
            $prov=json_decode($this->UbigeoController->getProvincia($request,$datos->delivery_datos->iddepartamento));
            $dist=json_decode($this->UbigeoController->getDistrito($request,$datos->delivery_datos->idprovincia));

      
            //print_r(json_encode($datos));
            return view('registroAtencion/atencion/receta',['datos'=>$datos,
            'tipos'=>$tipos,'pais'=>$pais,'prov'=>$prov,'dist'=>$dist,'pdf'=>$pdf]);
        }else{
            return view('registroAtencion/atencion/receta',['datos'=>$datos,
            'tipos'=>$tipos,'pdf'=>$pdf]);
        }
       
    }
    
    //descanso
    public function descanso(Request $request){
        $datos=session('descanso');
        $pdf=$this->getDescansoPDF();
        $dianostics=json_decode($this->DiagnosticoController->getDiagnosticos($request));

        return view('registroAtencion/atencion/descanso',['datos'=>$datos,'pdf'=>$pdf,'dianostics'=>$dianostics]);
    }

    //getExamenPDF
    public function getExamenPDF(){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idatencion'=>session('examenes')->idatencion,
        'idprofesional'=>session('medico')->data[0]->info[0]->idprofesional];
        $url = $this->server2.'api/pdf_orden_examen';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);        
        return $result;
    }

    //getHistoria
    public function getHistoria(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'dni'=>session('paciente')->num_doc];
        $url = $this->server2.'api/get_ultimo_historial';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }


    //examenes
    public function examenes(Request $request){
        $datos=session('examenes');
        $pdf=$this->getExamenPDF();
        $tipos=json_decode($this->HistoriaClinicaController->getSeguroTopico());
        //print_r(json_encode($tipos));
        return view('registroAtencion/atencion/examenes',['datos'=>$datos,'pdf'=>$pdf,'tipos'=>$tipos]);
    }

    public function registrarAttention(Request $request){

      // exit(json_encode(session('diagnostico')));
        if(isset(session('paciente')->FechaInicioVigencia)){
            session('filiacion')->FechaInicioVigencia = session('paciente')->FechaInicioVigencia;
        }else{
            session('filiacion')->FechaInicioVigencia = "";
        }

        $firma = ["filename"=>"","base64"=>""];
        session('filiacion')->firmapaciente = session('firma');
        
        $urla = $this->server2.'api/generar_historiaclinica';
        // exit(json_encode(session('paciente')));
        $resulta = $this->getServices($urla,json_encode(session('filiacion')),session('medico')->data[0]->token);
        
        // exit(json_encode($resulta));
        if($resulta->status==200){
            session(['firmapaciente' =>$resulta->data->firma]);
            $idatencion=$resulta->data->idatencion;

            $dataf = ['idatencion'=>$idatencion];
            $urlf = $this->server2.'api/finalizar_atencion';
            $resultf = $this->getServices($urlf,json_encode($dataf),session('medico')->data[0]->token);

            //filiacion
            if(session('filiacion')!=null){
                $filiacion=session('filiacion');
                $filiacion->idatencion=$idatencion;
                session(['filiacion' => $filiacion]);
            }

            //diagnostico
            if(session('diagnostico')!=null){
                $diagnostico=session('diagnostico');
                $diagnostico->idatencion=$idatencion;
                session(['diagnostico' => $diagnostico]);
                $urld = $this->server2.'api/generar_hojaambulatoria_consulta';
                $resultd = $this->getServices($urld,json_encode(session('diagnostico')),session('medico')->data[0]->token);

                //exit(json_encode($resultd));
                if($resultd->status==200){

                    if(session('receta')!=null){
                        $receta=session('receta');
                        $receta->idatencion=$idatencion;
                        session(['receta' => $receta]);
                        $urlr = $this->server2.'api/generar_recetamedica_consulta';
                        $resultr = $this->getServices($urlr,json_encode(session('receta')),session('medico')->data[0]->token);
                        $receta->idreceta_h_ext=$resultr->data->idreceta_h_ext;
                        $receta->idreceta_h_bot=$resultr->data->idreceta_h_bot;
        
                        session(['receta' => $receta]);
            
                    }
        
                    //examenes
                    if(session('examenes')!=null){
                        $examenes=session('examenes');
                        $examenes->idatencion=$idatencion;
                        session(['examenes' => $examenes]);
        
                        $urle = $this->server2.'api/generar_examenesauxiliares_consulta';
                        $resulte = $this->getServices($urle,json_encode(session('examenes')),session('medico')->data[0]->token);
                        
                        $examenes->idexamenaux_h_I=$resulte->data->idexamenaux_h_I;
                        $examenes->idexamenaux_h_L=$resulte->data->idexamenaux_h_L;
        
                        session(['examenes' => $examenes]);
                     
                    }
        
                    //descanso
                    if(session('descanso')!=null){
                        $descanso=session('descanso');
                        $descanso->idatencion=$idatencion;
                        session(['descanso' => $descanso]);
                        $urldes = $this->server2.'api/generar_descansomedico_consulta';
                        $resultdes = $this->getServices($urldes,json_encode(session('descanso')),session('medico')->data[0]->token); 
                    
                    }
    
                    $request->session()->put(['finalizar'=>1]);
                    return redirect('finish_attention');  
                 
                }else{
                    $request->session()->put(['finalizar'=>2]);
    
                    return redirect('finish_attention');  
                } 
            }

           
   
        }else{

            $request->session()->put(['finalizar'=>2]);
    
            return redirect('finish_attention'); 

        }

     
    }


    //pdf descanso
    public function getDescansoPDF(){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idatencion'=>session('descanso')->idatencion,
        'idprofesional'=>session('medico')->data[0]->info[0]->idprofesional];
        $url = $this->server2.'api/pdf_orden_descanso';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);        
        return $result;
    }

    //pdf recetaPDF
    public function recetaPDF(){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idatencion'=>session('receta')->idatencion];
        $url = $this->server2.'api/pdf_orden_receta';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);        
        return $result;
    }

    public function allAttentions(Request $request){
        $antenciones = $this->getAtenciones($request['dni']);
        $dispo=$this->DiagnosticoController->getJsonDisposicion($request);
        $orina=$this->DiagnosticoController->getJsonOrina($request);
        $tipos=json_decode($this->HistoriaClinicaController->getSeguroTopico());
        $dianostics=json_decode($this->DiagnosticoController->getDiagnosticos($request));
        // exit(json_encode($antenciones));
        //print_r(json_encode($antenciones));
        return view('registroAtencion/atencion/allAttentions',['antenciones'=>$antenciones,
        'dispo'=>$dispo,'orina'=>$orina,'tipos'=>$tipos,'dianostics'=>$dianostics]);
    }

    public function getAtenciones($dni){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,
        'dni'=>$dni];
        $url = $this->server2.'api/get_base_atencion_dni';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);        
        return $result;
    }
}
