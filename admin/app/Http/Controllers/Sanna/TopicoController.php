<?php

namespace App\Http\Controllers\Sanna;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class TopicoController extends Controller
{
    //
    use conection;

    public function getMedicamentSelect(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_medicamentos_select_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function calendario(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico=$request['idtopico'];
        
        //$planilla = json_decode($this->getPlanilla($request));
        $data=['idtopico'=>$idtopico,'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/get_topico_horario';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return view('gestionDatos/topicos/calendario_horariotopico',['idtopico'=>$idtopico,'idbotiquin'=>$request['idbotiquin'],
        'calendario'=>$calendario,'new'=>$request['new']]);

    }
	
	
	
	public function deleteGrupoTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico=$request['idtopico'];
        
      
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
		'idtopico'=>$request['idtopico'],'idgrupo'=>$request['idgrupo'],'type'=>$request['tipo']];
		
        $url = $this->server2.'api/delete_grupo_topico';
        $response = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  $response;

    }
	

    //getDiagnosticGroup
    public function getDiagnosticGroup(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_diagnosticos_select_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    
    //getExamenSelect
    public function getExamenSelect(Request $request,$tipo = null){
        if($request['tipo']){
            $idparent=$request['idparent'];
        }else{
            $tipo = $tipo;
        }
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,
        'lat'=>$lat,'long'=>$long,'query'=>$query,'tipo'=>$tipo];
        $url = $this->server2.'api/get_examen_select_grupo';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function __construct(){
        if(!\Session::has('tableGrupoM')) \Session::put('tableGrupoM', array());
        if(!\Session::has('tableGrupoExamenI')) \Session::put('tableGrupoExamenI', array());
        if(!\Session::has('tableGrupoExamenL')) \Session::put('tableGrupoExamenL', array());
        if(!\Session::has('tableGrupoDiagnostic')) \Session::put('tableGrupoDiagnostic', array());

    }  

    
    //tableGrupoM
    public function tableGrupoM(Request $request){
        $tableGrupoM = \Session::get('tableGrupoM');
        $medicamentosgroup = json_decode($this->getMedicamentSelect($request));
        $array = $request['idgrupo'];

        foreach($medicamentosgroup->data as $item){
            if (in_array($item->idgrupo, $array)){
                $tableGrupoM[$item->idgrupo]=$item;
            }

        }
        
        \Session::put('tableGrupoM',$tableGrupoM);
        return $tableGrupoM; 
    }

    //tableGrupoExamenI
    public function tableGrupoExamenI(Request $request){
        $tableGrupoExamenI = \Session::get('tableGrupoExamenI');
        $groupexamenesI = json_decode($this->getExamenSelect($request,$request['tipo']));
        $array = $request['idgrupo'];
        foreach($groupexamenesI->data as $item){
            if (in_array($item->idgrupo, $array)){
                $tableGrupoExamenI[$item->idgrupo]=$item;
            }
        }
        \Session::put('tableGrupoExamenI',$tableGrupoExamenI);
        return $tableGrupoExamenI; 
    }

    //tableGrupoExamenL
    public function tableGrupoExamenL(Request $request){
        $tableGrupoExamenL = \Session::get('tableGrupoExamenL');
        $groupexamenesL = json_decode($this->getExamenSelect($request,$request['tipo']));
        $array = $request['idgrupo'];

        foreach($groupexamenesL->data as $item){
            if (in_array($item->idgrupo, $array)){
                $tableGrupoExamenL[$item->idgrupo]=$item;
            }
        }
        \Session::put('tableGrupoExamenL',$tableGrupoExamenL);
        return $tableGrupoExamenL; 
    }

    //tableDiagnostico
    public function tableDiagnostico(Request $request){
        $tableDiagnostico = \Session::get('tableDiagnostico');
        $groupDiagnostic = json_decode($this->getDiagnosticGroup($request));
        $array = $request['idgrupo'];

        foreach($groupDiagnostic->data as $item){
            if (in_array($item->idgrupo, $array)){
                $tableDiagnostico[$item->idgrupo]=$item;
            }
        }
        \Session::put('tableDiagnostico',$tableDiagnostico);
        return $tableDiagnostico; 
    }


    
    public function nuevoTopico(Request $request){
        $empresas= json_decode($this->getEmpresas($request));
        $pais= json_decode($this->getPais($request));
        $aseguradoras= json_decode($this->getAseguradoras($request));
        $tipoSeguro= json_decode($this->getTipoSeguro($request));
        $tipoCondicion= json_decode($this->getTipoCodicion($request));
        $tipoProfesional= json_decode($this->getTipoProfesional($request));
        $brokers= json_decode($this->getBrokers($request));
        //print_r(json_encode($brokers));
        return view('gestionDatos/topicos/nuevo',['tipoCondicion'=>$tipoCondicion,'tipoSeguro'=>$tipoSeguro,
        'aseguradoras'=>$aseguradoras,'pais'=>$pais,'empresas'=>$empresas,'tipoProfesional'=>$tipoProfesional,'brokers'=>$brokers]);
    }

    //detalleTopico
    public function detalleTopico(Request $request){
        $info = json_decode($this->getTopicoDetail($request,$request['idtopico']));
        //print_r(json_encode($info));
        return view('gestionDatos/topicos/detalle',['idbotiquin'=>$request['idbotiquin'],'info'=>$info,'idtopico'=>$request['idtopico'],'nombre'=>$request['nombre']]);
    }

    public function topicoInicio(Request $request){   
        $tipoProfesional = json_decode($this->getTipoProfesional($request));
        $request->session()->put(['idsubfuncionalidad'=>$request['idsubfuncionalidad']]);
        return view('gestionDatos/topicos/inicio',['tipoProfesional'=>$tipoProfesional]);
    }    

    //detalleTopico
    public function editTopico(Request $request){
        $info = json_decode($this->getTopicoDetail($request,$request['idtopico']));
        $empresas= json_decode($this->getEmpresas($request));
        $pais= json_decode($this->getPais($request));
        $aseguradoras= json_decode($this->getAseguradoras($request));
        $tipoSeguro= json_decode($this->getTipoSeguro($request));
        $tipoCondicion= json_decode($this->getTipoCodicion($request));
        $tipoProfesional= json_decode($this->getTipoProfesional($request));
        $brokers= json_decode($this->getBrokers($request));
        
        //print_r(json_encode($info));
        
       return view('gestionDatos/topicos/editar',['tipoCondicion'=>$tipoCondicion,'tipoSeguro'=>$tipoSeguro,
        'aseguradoras'=>$aseguradoras,'pais'=>$pais,'empresas'=>$empresas,'tipoProfesional'=>$tipoProfesional,'brokers'=>$brokers,
        'info'=>$info,'idtopico'=>$request['idtopico'],'nombre'=>$request['nombre']]); 
    }

    //getEmpresas
    public function getEmpresas(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_empresas';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getSedeEmpresa
    public function getSedeEmpresa(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario, 'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idempresa'=>$request['idempresa']];
        $url = $this->server2.'api/get_sede_empresa';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getPais
    public function getPais(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_pais';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getProvincia
    public function getProvincia(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idparent'=>$request['idparent']];
         $url = $this->server2.'api/get_provincia';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getDistrito
    public function getDistrito(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,'idparent'=>$request['idparent']];
        $url = $this->server2.'api/get_distrito';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getAseguradoras
    public function getAseguradoras(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_aseguradoras';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getTipoSeguro
    public function getTipoSeguro(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_tipo_seguro';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getTipoCodicion
    public function getTipoCodicion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_tipo_condiciones';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getTipoProfesional
    public function getTipoProfesional(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_tipo_pofesional';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //getBrokers
    public function getBrokers(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        $url = $this->server2.'api/get_brokers';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }



    //Topico table
    public function getTopicoTabla(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $fecha_ini = $request['fecha_ini'];
        $fecha_fin = $request['fecha_fin'];
        if(empty($fecha_ini))$fecha_ini = "";
        if(empty($fecha_fin))$fecha_fin = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'pag'=>$request['pag'],'petxpag'=>$request['petxpag'],
        'query'=>$query,'tipo_profesional'=>$request['tipo_profesional'],'fecha_ini'=>$request['fecha_ini'],'fecha_fin'=>$request['fecha_fin']];
        $url = $this->server2.'api/get_topicos_tabla';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }


    //getTopicoDetail
    public function getTopicoDetail(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>$request['idtopico']];
        $url = $this->server2.'api/get_topico_detalle';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //deleteMedicTopico
    public function deleteMedicTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idbotiquinitem'=>$request['idbotiquinitem']];
        $url = $this->server2.'api/eliminar_item_botiquin';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //getHorarioTopico
    public function getHorarioTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>$request['idtopico']];
        $url = $this->server2.'api/get_topico_horario';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function editarHorarioTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $idtopico=$request['idtopico'];
        $horario=$request['horario'];
        $eliminados=$request['eliminados'];
       

        $data=['idtopico'=>$idtopico,'horario'=>$horario,'eliminados'=>$eliminados, 'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long];
        
        $url = $this->server2.'api/editar_topico_horariov2';
        $calendario = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        //print_r(json_encode($calendario));
        return  json_encode($calendario);

    }
    
    //deleteTopico
    public function deleteTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>$request['idtopico']];
        $url = $this->server2.'api/eliminar_topico';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }
    //aggTopico
    public function aggTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $cod_almacen = $request['cod_almacen'];
        if(empty($cod_almacen))$cod_almacen = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idempresa'=>$request['idempresa'],'nombre'=>$request['nombre'],
        'cod_cso'=>$request['cod_cso'],'fec_apertura'=>$request['fec_apertura'],'idubigeo'=>$request['idubigeo'],
        'direccion'=>$request['direccion'],'estado'=>$request['estado'],'idaseguradora'=>$request['idaseguradora'],
        'idtiposeguro'=>$request['idtiposeguro'],'idtipocondicion'=>$request['idtipocondicion'],
        'idprofesionales'=>$request['idprofesionales'],'ejecutivo'=>$request['ejecutivo'],
        'email_ejecutivo'=>$request['email_ejecutivo'],'tlf_ejecutivo'=>$request['tlf_ejecutivo'],'admincuenta'=>$request['admincuenta'],
        'email_admincuenta'=>$request['email_admincuenta'],'tlf_admincuenta'=>$request['tlf_admincuenta'],
        'broker'=>$request['broker'],'email_broker'=>$request['email_broker'],'tlf_broker'=>$request['tlf_broker'],
        'botiquin_ampliado'=>$request['botiquin_ampliado'],'cod_almacen'=>$cod_almacen];
            $url = $this->server2.'api/agregar_topico';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //updateTopico
    public function updateTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $cod_almacen = $request['cod_almacen'];
        if(empty($cod_almacen))$cod_almacen = "";
        $data=['idtopico'=>$request['idtopico'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idempresa'=>$request['idempresa'],'nombre'=>$request['nombre'],
        'cod_cso'=>$request['cod_cso'],'fec_apertura'=>$request['fec_apertura'],'idubigeo'=>$request['idubigeo'],
        'direccion'=>$request['direccion'],'estado'=>$request['estado'],'idaseguradora'=>$request['idaseguradora'],
        'idtiposeguro'=>$request['idtiposeguro'],'idtipocondicion'=>$request['idtipocondicion'],
        'idprofesionales'=>$request['idprofesionales'],'ejecutivo'=>$request['ejecutivo'],
        'email_ejecutivo'=>$request['email_ejecutivo'],'tlf_ejecutivo'=>$request['tlf_ejecutivo'],'admincuenta'=>$request['admincuenta'],
        'email_admincuenta'=>$request['email_admincuenta'],'tlf_admincuenta'=>$request['tlf_admincuenta'],
        'broker'=>$request['broker'],'email_broker'=>$request['email_broker'],'tlf_broker'=>$request['tlf_broker'],
        'botiquin_ampliado'=>$request['botiquin_ampliado'],'cod_almacen'=>$cod_almacen];
        $url = $this->server2.'api/editar_topico';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }


    //aggTopicoHorario
    public function aggHorarioTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idtopico'=>$request['idtopico'],'idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'horarios'=>$request['horario']];
        
        $url = $this->server2.'api/agregar_topico_horario';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    //editar_topico_horario
    public function updateHorarioTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'horarios'=>$request['horario']];
       $url = $this->server2.'api/editar_topico_horario';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    public function horario(Request $request){

        return view('gestionDatos/topicos/horario',['idtopico'=>$request['idtopico'],'idbotiquin'=>$request['idbotiquin']]);
    }

    public function editarHorario(Request $request){
        $horarios = json_decode($this->getHorarioTopico($request,$request['idtopico']));
        //print_r(json_encode($horarios));
        return view('gestionDatos/topicos/editarHorario',['horarios'=>$horarios,'idtopico'=>$request['idtopico']]);
    }

    public function aggGrupoMDE(Request $request){
        $new = $request['new'];
        if(empty($new))$new = 0;
        $request->session()->forget('tableGrupoM');
        $request->session()->forget('tableGrupoExamenI');
        $request->session()->forget('tableGrupoExamenL');
        $request->session()->forget('tableGrupoDiagnostic');

        
        $tipoI=0;
        $tipoL=1;
        $medicamentosgroup = json_decode($this->getMedicamentSelect($request));
        $groupexamenesI = json_decode($this->getExamenSelect($request,$tipoI));
        $groupexamenesL = json_decode($this->getExamenSelect($request,$tipoL));
        $groupDiagnostic = json_decode($this->getDiagnosticGroup($request));

       
        return view('gestionDatos/topicos/aggGrupoMDE',['groupDiagnostic'=>$groupDiagnostic,
        'groupexamenesI'=>$groupexamenesI,'groupexamenesL'=>$groupexamenesL,'idtopico'=>$request['idtopico'],
        'medicamentosgroup'=>$medicamentosgroup,'new'=>$new,'idbotiquin'=>$request['idbotiquin']]); 
    }


    //aggGrupoMTopico
    public function aggGrupoMTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idbotiquin'=>$request['idbotiquin'],'idgrupo_medi'=>$request['idgrupo_medi']];
        $url = $this->server2.'api/agregar_topico_grupo_medicamentos';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

 

    //aggGrupoExamenImgTopico
    public function aggGrupoExamenImgTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idbotiquin'=>$request['idbotiquin'],'idgrupo_examenI'=>$request['idgrupo_examenI']];
        $url = $this->server2.'api/agregar_topico_grupo_examenesI';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    //aggGrupoExamenLabTopico
    public function aggGrupoExamenLabTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idbotiquin'=>$request['idbotiquin'],'idgrupo_examenL'=>$request['idgrupo_examenL']];
        $url = $this->server2.'api/agregar_topico_grupo_examenesL';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    //aggTopicoGrupoDiagnostico
    public function aggTopicoGrupoDiagnostico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idbotiquin'=>$request['idbotiquin'],'idgrupo_diag'=>$request['idgrupo_diag']];
        $url = $this->server2.'api/agregar_topico_grupo_diagnosticos';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }
    
    public function aggGrupoMedicamentTopico(Request $request){
        $request->session()->forget('tableGrupoM');
        $medicamentosgroup = json_decode($this->getMedicamentSelect($request));
        return view('gestionDatos/topicos/aggGrupoMedicamentTopico',['medicamentosgroup'=>$medicamentosgroup,
        'idbotiquin'=>$request['idbotiquin'],'idtopico'=>$request['idtopico'],'nombre'=>$request['nombre']]);
    }
    
    public function aggGrupoExamenILtopico(Request $request){
        $tipoI=0;
        $tipoL=1;

        

        $groupexamenesI = json_decode($this->getExamenSelect($request,$tipoI));
        $groupexamenesL = json_decode($this->getExamenSelect($request,$tipoL));
        $grupos = json_decode($this->getGrupoExamen($request));
        // exit(json_encode($grupos));

        

        return view('gestionDatos/topicos/aggGrupoExamenILtopico',['groupexamenesI'=>$groupexamenesI,
        'groupexamenesL'=>$groupexamenesL,'idbotiquin'=>$request['idbotiquin'],
        'idtopico'=>$request['idtopico'],'nombre'=>$request['nombre'],'grupos'=>$grupos]);
    }


    public function getGrupoExamen(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idtopico'=>$request['idtopico'],'type'=>1];
       $url = $this->server2.'api/get_grupo_topico';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }


    public function aggGrupoDiagnosticoTopico(Request $request){
        $groupDiagnostic = json_decode($this->getDiagnosticGroup($request));
        return view('gestionDatos/topicos/aggGrupoDiagnosticoTopico',['groupDiagnostic'=>$groupDiagnostic,
        'idbotiquin'=>$request['idbotiquin'],'idtopico'=>$request['idtopico'],'nombre'=>$request['nombre']]);
    } 
    //getAllDiagnosticoTopico
    public function getAllDiagnosticoTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,'so'=>2,'lat'=>$lat,'long'=>$long,
        'idtopico'=>$request['idtopico'],'pag'=>$request['pag'],'petxpag'=>$request['petxpag']];
       $url = $this->server2.'api/get_diagnostico_topico';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    //getAllMedicamentoTopico
    public function getAllMedicamentoTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,
        'idtopico'=>$request['idtopico'],'pag'=>$request['pag'],'petxpag'=>$request['petxpag']];
       $url = $this->server2.'api/get_medicamento_topico_reposicion';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    //allExamenesTopico
    public function getAllExamenesTopico(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['idusuario'=>session('usuario')->data[0]->info[0]->idusuario,
        'so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query,
        'idtopico'=>$request['idtopico'],'pag'=>$request['pag'],'petxpag'=>$request['petxpag']];
       $url = $this->server2.'api/get_examen_topico';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result); 
    }

    //allDiagnosticoTopico
    public function allDiagnosticoTopico(Request $request){
        return view('gestionDatos/topicos/allDiagnosticoTopico',['idtopico'=>$request['idtopico']]);
    }


    //allExamenesTopico
    public function allExamenesTopico(Request $request){
        return view('gestionDatos/topicos/allExamenesTopico',['idtopico'=>$request['idtopico']]);
    }

     
    //allMedicamentosTopico
    public function allMedicamentosTopico(Request $request){
        return view('gestionDatos/topicos/allMedicamentosTopico',['idtopico'=>$request['idtopico']]);
    }


}
