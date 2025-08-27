<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class RecetaMedicaController extends Controller
{
    //
    use conection;

    protected $HistoriaClinicaController;
    protected $UbigeoController;
    protected $DiagnosticoController;

    public function __construct(HistoriaClinicaController $HistoriaClinicaController,
    UbigeoController $UbigeoController,DiagnosticoController $DiagnosticoController)
    {
       $this->HistoriaClinicaController = $HistoriaClinicaController;
       $this->UbigeoController = $UbigeoController;
       if(!\Session::has('tableMedicament')) \Session::put('tableMedicament', array());
       $this->DiagnosticoController = $DiagnosticoController;

    }
 
  
    //getMedicamentTopico
    public function getMedicamentTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,'query'=>$query];
        $url = $this->server2.'api/get_medicamento_topico';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }



    //saveRecetaSession
    public function saveRecetaSession(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';

        $delivery_datos = $request['delivery_datos'];
        if(empty($delivery_datos))$delivery_datos = "";

        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,'codigoreceta'=>$request['codigoreceta'], 
        'so'=>2,'lat'=>$lat,'long'=>$long,'delivery'=>$request['delivery'],'delivery_datos'=>$delivery_datos,
        'indicaciones'=>$request['indicaciones'],'medicamentoslista'=>$request['medicamentoslista']];
        $dataU = $object = json_decode(json_encode($data), FALSE);
        $request->session()->put(['receta'=>$dataU]);

        return "ok";
       
    }

    //recetaMedica
    public function recetaMedica(Request $request){
        $medicamentos = json_decode($this->getMedicamentTopico($request));
        //$request->session()->forget('receta');
        $dataU = $object = json_decode(json_encode(session('receta')), FALSE);
        $dianostics=json_decode($this->DiagnosticoController->getDiagnosticos($request));
        $histori=$this->HistoriaClinicaController->getHistoria($request);
        //print_r(json_encode($dataU));

        $pais=json_decode($this->UbigeoController->getPais($request));
        return view('registroAtencion/recetaMedica',['histori'=>$histori,
        'medicamentos'=>$medicamentos,'pais'=>$pais,'dianostics'=>$dianostics]); 
        
    }


    //addMedicament
    public function addMedicament(Request $request){
        $tableMedicament = \Session::get('tableMedicament');
        $medicamentos = json_decode($this->getMedicamentTopico($request));
     /*    foreach($medicamentos->data as $item){
            if ($request['idmedicamento']==$item->idmedicamento){
                $tableMedicament[]=$item;
            }
        }

        Session::put('tableMedicament',$tableMedicament); */

        return json_encode($medicamentos);
    }

    //deletetableMedicament
    public function deletetableMedicament (Request $request){
        
        $dataU = $object = json_decode(json_encode(session('receta')), FALSE);
        $medic = $dataU->medicamentoslista;
        
        $key = array_search($request['idmedicamento'],array_column($medic,'idmedicamento'));
        unset($medic[$key]);
        $a = array_values($medic);

        $receta = ['delivery'=>$dataU->delivery,'delivery_datos'=>$dataU->delivery_datos,
        'idprofesional'=>$dataU->idprofesional,'indicaciones'=>$dataU->indicaciones,'lat'=>$dataU->lat,
        'long'=>$dataU->long,'so'=>$dataU->so,'medicamentoslista'=>$a];

        //print_r(json_encode($dataU));
        \Session::put('receta',$receta);
        //print_r(json_encode(session('receta')));
        return 'ok'; 
    }

    //updateTableMedicament
    public function updateTableMedicament(Request $request){
        $tableMedicament =\Session::get('tableMedicament');
        //print_r($request['cantidad']);

        $medicamentoslista = $object = json_decode(json_encode($request['medicamentoslista']), FALSE);
        
        foreach($medicamentoslista as $item){
            $tableMedicament[$item->idmedicamento]->cantidadE=$item->cantidad;
            $tableMedicament[$item->idmedicamento]->dosis=$item->dosis;
            $tableMedicament[$item->idmedicamento]->via_administracion=$item->via_administracion;
            $tableMedicament[$item->idmedicamento]->frecuencia=$item->frecuencia;
            $tableMedicament[$item->idmedicamento]->duracion=$item->duracion;
            $tableMedicament[$item->idmedicamento]->cie10=$item->cie10;
            $tableMedicament[$item->idmedicamento]->fuente=$item->fuente;
            $tableMedicament[$item->idmedicamento]->stock=$item->stock;

        }
    
        \Session::put('tableMedicament',$tableMedicament);
        return 'ok';
    }

 

}
