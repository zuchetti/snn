<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 


class SitedsController extends Controller
{
    //
    use conection;

    //get paciente
    public function getPaciente(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';

        $num_doc = $request['num_doc'];
        if(empty($num_doc))$num_doc = "";

        $tipo_doc = $request['tipo_doc'];
        if(empty($tipo_doc))$tipo_doc = "";

        $nombres = $request['nombres'];
        if(empty($nombres))$nombres = "";
        $ape_paterno = $request['ape_paterno'];
        if(empty($ape_paterno))$ape_paterno = "";
        $ape_materno = $request['ape_materno'];
        if(empty($ape_materno))$ape_materno = "";
        $num_doc = $request['num_doc'];
        if(empty($num_doc))$num_doc = "";
        $tipo_doc = $request['tipo_doc'];
        if(empty($tipo_doc))$tipo_doc = "";

        $data=['tipo_doc'=>$tipo_doc,'num_doc'=>$num_doc,'ruc'=>'20251011461',
        'sunasa'=>'00023920','iafas'=>$request['iafas'],
        'nombres'=>$request['nombres'],'ape_paterno'=>$request['ape_paterno'],
        'ape_materno'=>$request['ape_materno'],'codespecial'=>"",'so'=>2,'lat'=>$lat,'long'=>$long];
        // exit(json_encode($data));
        $url = $this->server2.'api/get_pacientes_siteds';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }


    //getDetailPaciente
    public function getDetailPaciente($codaff,$iafas,$CodProducto,$DesProducto,$ApellidoPaternoAfiliado,$ApellidoMaternoAfiliado,
        $NombresAfiliado,$CodParentesco,$NombreContratante,$CodigoAfiliado,$CodTipoDocumentoAfiliado,$NumeroDocumentoAfiliado,
        $NumeroPlan,$NumeroDocumentoContratante,$TipoCalificadorContratante,$CodTipoDocumentoContratante){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['SUNASA'=>'00023920','IAFAS'=>$iafas,'RUC'=>'20251011461',
        'CodProducto'=>$CodProducto,
        'DesProducto'=>$DesProducto,
        'ApellidoPaternoAfiliado'=>$ApellidoPaternoAfiliado,
        'ApellidoMaternoAfiliado'=>$ApellidoMaternoAfiliado,
        'NombresAfiliado'=>$NombresAfiliado,
        'CodParentesco'=>$CodParentesco,
        'NombreContratante'=>$NombreContratante,
        'CodigoAfiliado'=>$codaff,
        'CodTipoDocumentoAfiliado'=>$CodTipoDocumentoAfiliado,
        'NumeroDocumentoAfiliado'=>$NumeroDocumentoAfiliado,
        'NumeroPlan'=>$NumeroPlan,
        'NumeroDocumentoContratante'=>$NumeroDocumentoContratante,
        'TipoCalificadorContratante'=>$TipoCalificadorContratante,
        'CodTipoDocumentoContratante'=>$CodTipoDocumentoContratante,
        'CodEspecialidad'=>"",
        'so'=>2,'lat'=>$lat,'long'=>$long];
        // exit(json_encode($data));
        $url = $this->server2.'api/get_detalle_pacientes_siteds';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }



}
