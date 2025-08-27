<?php


namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class ExamenController extends Controller
{
    //
    use conection;

    protected $HistoriaClinicaController;
    protected $DiagnosticoController;
    public function __construct(HistoriaClinicaController $HistoriaClinicaController,
    DiagnosticoController $DiagnosticoController)
    {
       $this->HistoriaClinicaController = $HistoriaClinicaController;
       $this->DiagnosticoController = $DiagnosticoController;

    }



    //getExamenImgTopico
    public function getExamenImgTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,'query'=>$query];
        $url = $this->server2.'api/get_examen_imagen_topico';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    //getcie10Session
    public function getcie10Session(Request $request){
        $arrayCie10 = explode(',', session('paciente')->cie10);
        return json_encode($arrayCie10);
    }

    //getExamenLabTopico
    public function getExamenLabTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,'query'=>$query];
        $url = $this->server2.'api/get_examen_laboratorio_topico';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    
        

    public function saveExamenesSession(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';

        $lab = $request['lab'];
        if(empty($lab))$lab = "";

        $img = $request['img'];
        if(empty($img))$img = "";
        
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,'so'=>2,
        'lat'=>$lat,'long'=>$long,
       'lab'=>$lab,'img'=>$img];
       $dataU = $object = json_decode(json_encode($data), FALSE);
       $request->session()->put(['examenes'=>$dataU]);

       return "ok";
    }

    //examenesAuxiliares
    public function examenesAuxiliares(Request $request){
        $examenImg = json_decode($this->getExamenImgTopico($request));
        $examenLab = json_decode($this->getExamenLabTopico($request));
        $histori=$this->HistoriaClinicaController->getHistoria($request);
        $dianostics=json_decode($this->DiagnosticoController->getDiagnosticos($request));
        //print_r(json_encode(session('examenes')));
        //$request->session()->forget('examenes');
        //print_r(json_encode($dianostics));
        return view('registroAtencion/examenesAuxiliares',['examenImg'=>$examenImg,'histori'=>$histori,
        'examenLab'=>$examenLab,'dianostics'=>$dianostics]);
    }

    

}
