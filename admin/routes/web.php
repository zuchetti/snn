<?php


use App\Http\Controllers\Sanna\AuthController;
use App\Http\Controllers\Sanna\DashboardController;
use App\Http\Controllers\Sanna\MedicamentosController;
use App\Http\Controllers\Sanna\UserController;
use App\Http\Controllers\Sanna\TopicoController;
use App\Http\Controllers\Sanna\ExamenauxiliarController;
use App\Http\Controllers\Sanna\ActivosFijosController;
use App\Http\Controllers\Sanna\ProveedoresController;
use App\Http\Controllers\Sanna\DiagnosticoController;
use App\Http\Controllers\Sanna\PersonaMedicoController;
use App\Http\Controllers\Sanna\ClientesController;
use App\Http\Controllers\Sanna\CondicionesController;
use App\Http\Controllers\Sanna\SegurosController;
use App\Http\Controllers\Sanna\AseguradorasController;
use App\Http\Controllers\Sanna\PlanillasController;
use App\Http\Controllers\Sanna\ProgramacionMedica;
use App\Http\Controllers\Sanna\HistoriasClinicasController;
use App\Http\Controllers\Sanna\ReportesController;
use App\Http\Controllers\Sanna\PedidosReposicion;

use Illuminate\Support\Facades\Route;

Route::get('prueba', [AuthController::class, 'prueba']);

Route::get('prueba', [AuthController::class, 'prueba']);

/////////////////////Auth/////////////////////
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $exitCode = Artisan::call('config:clear');

    return view('login/login');

});


//code


Route::get('validate', [AuthController::class, 'validarCodigo']);
Route::post('validate_code', [AuthController::class, 'validateCode']);


Route::group(['middleware'=>['validarToken']],function(){


Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('deleteGroup', [DashboardController::class, 'deleteGroup']);
Route::post('validate_code_first', [AuthController::class, 'validateCodeFirst']);
Route::get('autentication_googleauth', [AuthController::class, 'googleauth']);

// Gestión de datos
Route::get('gestiondebasededatos', [DashboardController::class, 'gestiondebasededatos']);

// Medicamentos

    Route::get('medicamentos', [MedicamentosController::class, 'medicamentos']);
    Route::get('nuevoGrupo', [MedicamentosController::class, 'nuevoGrupo']);
    Route::get('getMedicamentos', [MedicamentosController::class, 'getMedicamentos']);
    Route::get('createMedicamento', [MedicamentosController::class, 'createMedicamento']);
    Route::get('aggMedicamentAll', [MedicamentosController::class, 'aggMedicamentAll']);
    Route::post('getMedicamentosGrupoTable', [MedicamentosController::class, 'getMedicamentosGrupoTable']);
    Route::post('getMedicamentosAllTable', [MedicamentosController::class, 'getMedicamentosAllTable']);
    Route::get('nuevoMedicamento', [MedicamentosController::class, 'nuevoMedicamento']);
    Route::get('detalleGrupo', [MedicamentosController::class, 'detalleGrupo']);
    Route::post('getDetailGrupo', [MedicamentosController::class, 'getDetailGrupo']);
    Route::get('deleteMedicamento', [MedicamentosController::class, 'deleteMedicamento']);
    Route::get('deleteMedicamentAll', [MedicamentosController::class, 'deleteMedicamentAll']);
    Route::get('editMedicamentoAll', [MedicamentosController::class, 'editMedicamentoAll']);
    Route::get('editMedicamento', [MedicamentosController::class, 'editMedicamento']);
    Route::get('agregarMedicamentoGrupo', [MedicamentosController::class, 'agregarMedicamentoGrupo']);
    Route::get('agregaritemGrupo', [MedicamentosController::class, 'agregaritemGrupo']);
    Route::get('addMedicament', [MedicamentosController::class, 'addMedicament']);


Route::get('usuarios', [UserController::class, 'usuario']);
Route::post('getusuarios', [UserController::class, 'getUsers']);
Route::get('editarusuario', [UserController::class, 'editarusuario']);
Route::get('posteditarusuario', [UserController::class, 'postEditusuario']);
Route::get('crearusuario', [UserController::class, 'crearusuario']);
Route::get('postcrearusuario', [UserController::class, 'postcrearusuario']);
Route::get('borrarusuario', [UserController::class, 'borrarusuario']);

Route::get('administrarMedicamento', function () {
    return view('gestionDatos/medicamentos/administrar');
});

// Tópicos

    Route::get('topicos', [TopicoController::class, 'topicoInicio']);
	
	Route::post('delete_grupo_topico',[TopicoController::class, 'deleteGrupoTopico'])->name('delete_grupo_topico');
	
    Route::get('allDiagnosticoTopico', [TopicoController::class, 'allDiagnosticoTopico']);
    Route::get('allExamenesTopico', [TopicoController::class, 'allExamenesTopico']);
    Route::get('allMedicamentosTopico', [TopicoController::class, 'allMedicamentosTopico']);
    Route::post('getTopicoTabla', [TopicoController::class, 'getTopicoTabla']);
    Route::post('getAllDiagnosticoTopico', [TopicoController::class, 'getAllDiagnosticoTopico']);
    Route::post('getAllMedicamentoTopico', [TopicoController::class, 'getAllMedicamentoTopico']);
    Route::post('getAllExamenesTopico', [TopicoController::class, 'getAllExamenesTopico']);
    Route::get('nuevoTopico', [TopicoController::class, 'nuevoTopico']);
    Route::get('deleteTopico', [TopicoController::class, 'deleteTopico']);
    Route::get('calendario_horariotopico', [TopicoController::class, 'calendario']);
    Route::get('horario', [TopicoController::class, 'horario']);
    Route::get('editarHorario', [TopicoController::class, 'editarHorario']);
    Route::get('editarHorarioTopico', [TopicoController::class, 'editarHorarioTopico']);
    Route::get('getSedeEmpresa', [TopicoController::class, 'getSedeEmpresa']);
    Route::get('getPais', [TopicoController::class, 'getPais']);
    Route::get('getProvincia', [TopicoController::class, 'getProvincia']);
    Route::get('getDistrito', [TopicoController::class, 'getDistrito']);
    Route::get('aggTopico', [TopicoController::class, 'aggTopico']);
    Route::get('detalleTopico', [TopicoController::class, 'detalleTopico']);
    Route::get('editTopico', [TopicoController::class, 'editTopico']);
    Route::get('updateTopico', [TopicoController::class, 'updateTopico']);
    Route::get('aggHorarioTopico', [TopicoController::class, 'aggHorarioTopico']);
    Route::get('updateHorarioTopico', [TopicoController::class, 'updateHorarioTopico']);
    Route::get('aggGrupoMDE', [TopicoController::class, 'aggGrupoMDE']);
    Route::get('aggGrupoMTopico', [TopicoController::class, 'aggGrupoMTopico']);
    Route::get('tableGrupoM', [TopicoController::class, 'tableGrupoM']);
    Route::get('tableGrupoExamenI', [TopicoController::class, 'tableGrupoExamenI']);
    Route::get('tableGrupoExamenL', [TopicoController::class, 'tableGrupoExamenL']);
    Route::get('tableDiagnostico', [TopicoController::class, 'tableDiagnostico']);
    Route::get('aggGrupoExamenImgTopico', [TopicoController::class, 'aggGrupoExamenImgTopico']);
  

    // Tópicos
Route::get('aggGrupoExamenLabTopico', [TopicoController::class, 'aggGrupoExamenLabTopico']);
Route::get('aggTopicoGrupoDiagnostico', [TopicoController::class, 'aggTopicoGrupoDiagnostico']);
Route::get('aggGrupoExamenILtopico', [TopicoController::class, 'aggGrupoExamenILtopico']);
Route::get('aggGrupoMedicamentTopico', [TopicoController::class, 'aggGrupoMedicamentTopico']);
Route::get('aggGrupoDiagnosticoTopico', [TopicoController::class, 'aggGrupoDiagnosticoTopico']);
Route::get('delete_medic_topico', [TopicoController::class, 'deleteMedicTopico']);

// Examenes auxiliares

    Route::get('examenesauxiliares', [ExamenauxiliarController::class, 'examenauxiliar']);
    Route::post('getExamenauxiliarGrupoTabla', [ExamenauxiliarController::class, 'getExamenauxiliarGrupoTabla']);
    Route::get('detalleGrupoExamen', [ExamenauxiliarController::class, 'detalleGrupo']);
    Route::post('getDetalleGrupo', [ExamenauxiliarController::class, 'getDetalleGrupo']);
    Route::get('deleteGrupoExamen', [ExamenauxiliarController::class, 'deleteGrupoExamen']);
    Route::post('getExamenesAllTable', [ExamenauxiliarController::class, 'getExamenesAllTable']);
    Route::get('editExamenAll', [ExamenauxiliarController::class, 'editExamenAll']);
    Route::get('editExamen', [ExamenauxiliarController::class, 'editExamen']);
    Route::get('deleteExamenAll', [ExamenauxiliarController::class, 'deleteExamenAll']);
    Route::get('nuevoExamen', [ExamenauxiliarController::class, 'nuevoExamen']);
    Route::get('aggExamenAll', [ExamenauxiliarController::class, 'aggExamenAll']);
    Route::get('createExamenGrupo', [ExamenauxiliarController::class, 'createExamenGrupo']);
    Route::get('agregaritemGrupoExamen', [ExamenauxiliarController::class, 'agregaritemGrupoExamen']);
    Route::get('agregaritemGrupoExamenI', [ExamenauxiliarController::class, 'agregaritemGrupoExamenI']);
    Route::get('agregarExamenGrupo', [ExamenauxiliarController::class, 'agregarExamenGrupo']);


Route::get('administrarExamen', function () {
    return view('gestionDatos/examenesauxiliares/administrar');
});

Route::get('nuevoGrupoExamen', [ExamenauxiliarController::class, 'nuevoGrupoExamen']);
Route::get('addExamenLab', [ExamenauxiliarController::class, 'addExamenLab']);
Route::get('nuevoGrupoExamenI', [ExamenauxiliarController::class, 'nuevoGrupoExamenI']);
Route::get('addExamenImagen', [ExamenauxiliarController::class, 'addExamenImagen']);


  

   

    
    //------------activosFijos-----------------

    Route::get('administrarActivosFijos', function () {
        return view('gestionDatos/activosFijos/administrar');
    });
    
    Route::get('activosfijos', [ActivosFijosController::class, 'activosFijos']);
    Route::get('nuevoGrupoActivoFijo', [ActivosFijosController::class, 'nuevoGrupoActivoFijo']);
    Route::get('addActivoFijo', [ActivosFijosController::class, 'addActivoFijo']);
    Route::get('nuevoActivoFijo', [ActivosFijosController::class, 'nuevoActivoFijo']);
    
    Route::post('getActivosFijosTableGrupo', [ActivosFijosController::class, 'getActivosFijosTableGrupo']);
    Route::post('getActivosFijosDetailGrupo', [ActivosFijosController::class, 'getActivosFijosDetailGrupo']);
    Route::get('detalleGrupoActivosFijos', [ActivosFijosController::class, 'detalleGrupoActivosFijos']);
    Route::get('deleteGrupoActivosFijos', [ActivosFijosController::class, 'deleteGrupoActivosFijos']);
    Route::get('createGrupoActivoFijo', [ActivosFijosController::class, 'createGrupoActivoFijo']);
    Route::post('getActivosFijosTable', [ActivosFijosController::class, 'getActivosFijosTable']);
    Route::get('deleteActivoFijo', [ActivosFijosController::class, 'deleteActivoFijo']);
    Route::get('editActivoFijo', [ActivosFijosController::class, 'editActivoFijo']);
    Route::get('aggActivosFijos', [ActivosFijosController::class, 'aggActivosFijos']);
    Route::get('updateActivosFijos', [ActivosFijosController::class, 'updateActivosFijos']);
    Route::get('agregaritemGrupoActivofijo', [ActivosFijosController::class, 'agregaritemGrupo']);
    Route::get('agregarActivofijoGrupo', [ActivosFijosController::class, 'agregarActivofijoGrupo']);
    
    // Proveedores
    Route::get('nuevoProveedor', [ProveedoresController::class, 'nuevoProveedor']);
    Route::get('proveedores', [ProveedoresController::class, 'proveedores']);
    Route::post('getProveedoresTable', [ProveedoresController::class, 'getProveedoresTable']);
    Route::get('aggProveedor', [ProveedoresController::class, 'aggProveedor']);
    Route::get('deleteProveedor', [ProveedoresController::class, 'deleteProveedor']);
    Route::get('detalleProveedor', [ProveedoresController::class, 'detalleProveedor']);
    Route::get('editProveedor', [ProveedoresController::class, 'editProveedor']);
    Route::get('updateProveedor', [ProveedoresController::class, 'updateProveedor']);
    



    //------------diagnostico-----------------
   
    Route::get('nuevoDiagnostico', function () {
        return view('gestionDatos/diagnostico/nuevo');
    });
    
    Route::get('diagnostico', [DiagnosticoController::class, 'diagnostico']);
    Route::get('nuevoGrupoDiagnostico', [DiagnosticoController::class, 'nuevoGrupoDiagnostico']);
    Route::get('addDiagnostico', [DiagnosticoController::class, 'addDiagnostico']);
    
    Route::get('administrarDiagnosticos', function () {
        return view('gestionDatos/diagnostico/administrar');
    });
    
    Route::post('getDiagnosticoGrupoTable', [DiagnosticoController::class, 'getDiagnosticoGrupoTable']);
    Route::get('detalleGrupoDiagnostico', [DiagnosticoController::class, 'detalleGrupoDiagnostico']);
    Route::post('getDiagnosticoGrupoDetailTable', [DiagnosticoController::class, 'getDiagnosticoGrupoDetailTable']);
    Route::get('deleteDiagnosticoGrupo', [DiagnosticoController::class, 'deleteDiagnosticoGrupo']);
    Route::get('aggDiagnostico', [DiagnosticoController::class, 'aggDiagnostico']);
    Route::post('getDiagnosticoAllTable', [DiagnosticoController::class, 'getDiagnosticoAllTable']);
    Route::get('createGrupoDiagnostico', [DiagnosticoController::class, 'createGrupoDiagnostico']);
    Route::get('editDiagnostico', [DiagnosticoController::class, 'editDiagnostico']);
    Route::get('deleteDiagnosticoAll', [DiagnosticoController::class, 'deleteDiagnosticoAll']);
    Route::get('updateDiagnosticoAll', [DiagnosticoController::class, 'updateDiagnosticoAll']);
    Route::get('agregaritemGrupoDiagnostico', [DiagnosticoController::class, 'agregaritemGrupo']);
    Route::get('agregarDiagnosticoGrupo', [DiagnosticoController::class, 'agregarDiagnosticoGrupo']);
    
    // Personal médico
    Route::get('personalmedico', [PersonaMedicoController::class, 'personalMedicoInicio']);
    Route::post('getPersonalMedicoTable', [PersonaMedicoController::class, 'getPersonalMedicoTable']);
    Route::get('detallePersonalMedico', [PersonaMedicoController::class, 'detallePersonalMedico']);
    Route::get('nuevoPersonalMedico', [PersonaMedicoController::class, 'nuevoPersonalMedico']);
    Route::get('deletePersonalMedico', [PersonaMedicoController::class, 'deletePersonalMedico']);
    Route::get('editPersonalMedico', [PersonaMedicoController::class, 'editPersonalMedico']);
    Route::post('aggPersonalMedico', [PersonaMedicoController::class, 'aggPersonalMedico']);
    Route::post('updatePersonalMedico', [PersonaMedicoController::class, 'updatePersonalMedico']);
    Route::get('calendario_horariomedico', [PersonaMedicoController::class, 'calendario']);
    Route::get('editarHorarioPersonalmedico', [PersonaMedicoController::class, 'editarHorarioPersonalmedico']);
    Route::get('validacion_eliminar_horario', [PersonaMedicoController::class, 'validacion_eliminar_horario']);
    

    //------------clientes-----------------
    
  
    Route::get('clientes', [ClientesController::class, 'clientes']);
Route::post('getClientesTable', [ClientesController::class, 'getClientesTable']);
Route::get('deleteEmpresa', [ClientesController::class, 'deleteEmpresa']);
Route::get('clienteTable', [ClientesController::class, 'clienteTable']);
Route::get('deleteSubcliente', [ClientesController::class, 'deleteSubcliente']);
Route::get('nuevoCliente', [ClientesController::class, 'nuevoCliente']);
Route::get('addEmpresa', [ClientesController::class, 'addEmpresa']);
Route::get('nuevoSubcliente', [ClientesController::class, 'subcliente']);
Route::get('addSubcliente', [ClientesController::class, 'addSubcliente']);
Route::get('editCliente', [ClientesController::class, 'editCliente']);
Route::get('updateInfoEmpresa', [ClientesController::class, 'updateInfoEmpresa']);
Route::get('detalleEmpresa', [ClientesController::class, 'detalleEmpresa']);
Route::post('getClientesTableDetail', [ClientesController::class, 'getClientesTableDetail']);
Route::get('addSucliente', [ClientesController::class, 'addSucliente']);
Route::get('addSedeTable', [ClientesController::class, 'addSedeTable']);
Route::get('saveSubcliente', [ClientesController::class, 'saveSubcliente']);

Route::get('nuevoCondicion', function () {
    return view('gestionDatos/condiciones/nuevo');
});
Route::get('condiciones', [CondicionesController::class, 'condiciones']);
Route::post('getCondicionesTable', [CondicionesController::class, 'getCondicionesTable']);
Route::get('deleteCondicion', [CondicionesController::class, 'deleteCondicion']);
Route::get('addCondicion', [CondicionesController::class, 'addCondicion']);
Route::get('editCondicion', [CondicionesController::class, 'editCondicion']);
Route::get('updateCondicion', [CondicionesController::class, 'updateCondicion']);

Route::get('nuevoSeguro', function () {
    return view('gestionDatos/seguros/nuevo');
});
Route::get('seguros', [SegurosController::class, 'seguros']);
Route::post('getTipoSeguroTable', [SegurosController::class, 'getTipoSeguroTable']);
Route::get('deleteSeguro', [SegurosController::class, 'deleteSeguro']);
Route::get('editSeguro', [SegurosController::class, 'editSeguro']);
Route::get('updateSeguro', [SegurosController::class, 'updateSeguro']);
Route::get('addSeguro', [SegurosController::class, 'addSeguro']);

Route::get('aseguradoras', [AseguradorasController::class, 'aseguradoras']);
Route::get('nuevaAseguradora', function () {
    return view('gestionDatos/aseguradoras/nuevo');
});
Route::post('getAseguradorasTable', [AseguradorasController::class, 'getAseguradorasTable']);
Route::get('addAseguradora', [AseguradorasController::class, 'addAseguradora']);
Route::get('deleteAseguradora', [AseguradorasController::class, 'deleteAseguradora']);
Route::get('editAseguradora', [AseguradorasController::class, 'editAseguradora']);
Route::get('updateAseguradora', [AseguradorasController::class, 'updateAseguradora']);

Route::get('nuevaPlanilla', function () {
    return view('gestionDatos/planillas/nuevo');
});
Route::get('planilla', [PlanillasController::class, 'planillas']);
Route::post('getPlanillasTable', [PlanillasController::class, 'getPlanillasTable']);
Route::get('addPlanilla', [PlanillasController::class, 'addPlanilla']);
Route::get('deletePlanilla', [PlanillasController::class, 'deletePlanilla']);
Route::get('editPlanilla', [PlanillasController::class, 'editPlanilla']);
Route::get('updatePlanilla', [PlanillasController::class, 'updatePlanilla']);

Route::get('programacionmedica', function () {
    return view('programacionMedica/inicio');
});
// Route::get('calendario', function () {
//     return view('programacionMedica/calendario');
// });
Route::post('getProgramacionMedicaTable', [ProgramacionMedica::class, 'getProgramacionMedicaTable']);
Route::get('agregarProgramacionmedica', [ProgramacionMedica::class, 'agregarProgramacionmedica']);
Route::get('reemplazarProgramacionmedica', [ProgramacionMedica::class, 'reemplazarProgramacionmedica']);
Route::get('getProfesionalesDispo', [ProgramacionMedica::class, 'getProfesionalesDispo']);
Route::get('calendario', [ProgramacionMedica::class, 'calendario']);
Route::post('editarHorarioProgramacionmedica', [ProgramacionMedica::class, 'editarHorarioProgramacionmedica']);
Route::get('repetirProgramacion', [ProgramacionMedica::class, 'repetirProgramacion']);

Route::get('historiasclinicas', function () {
    return view('historiasClinicas/inicio');
});
Route::post('getHistoriasClinicasTable', [HistoriasClinicasController::class, 'getHistoriasClinicasTable']);
Route::post('detalleHistoriaClinicaTable', [HistoriasClinicasController::class, 'detalleHistoriaClinicaTable']);
Route::get('detalleHistoriaClinica', [HistoriasClinicasController::class, 'detalleHistoriaClinica']);
Route::get('detalleaAtencion', [HistoriasClinicasController::class, 'detalleaAtencion']);
Route::get('descargaHistoria', [HistoriasClinicasController::class, 'descargaHistoria']);
Route::get('pdf_siteds', [HistoriasClinicasController::class, 'pdfSiteds']);

Route::get('reportes', function () {
    return view('reportes/inicio');
});
Route::post('getmodulos', [ReportesController::class, 'getmodulos']);
Route::get('getreporte', [ReportesController::class, 'getreporte']);

Route::get('usuario', [UserController::class, 'usuario']);
Route::post('getusuarios', [UserController::class, 'getUsers']);
Route::get('editarusuario', [UserController::class, 'editarusuario']);
Route::get('posteditarusuario', [UserController::class, 'postEditusuario']);
Route::get('crearusuario', [UserController::class, 'crearusuario']);
Route::get('postcrearusuario', [UserController::class, 'postcrearusuario']);
Route::get('borrarusuario', [UserController::class, 'borrarusuario']);

Route::get('gestionmedicamentos', function () {
    return view('pedidos/inicio');
});
Route::get('pedidoDetail', [PedidosReposicion::class, 'pedidoDetail']);
Route::post('getSolicitudReposicion', [PedidosReposicion::class, 'getSolicitudReposicion']);
Route::post('getDetailPedido', [PedidosReposicion::class, 'getDetailPedido']);
Route::get('aprobarSolicitud', [PedidosReposicion::class, 'aprobarSolicitud']);
Route::get('denegarSolicitud', [PedidosReposicion::class, 'denegarSolicitud']);
Route::get('descargapedido', [PedidosReposicion::class, 'descargapedido']);
Route::get('medicamentos_topico', [PedidosReposicion::class, 'medicamentosTopico']);
Route::get('medic_TopicoDetail2', [PedidosReposicion::class, 'medicTopicoDetail2']);
Route::get('update_stockBotiquin', [PedidosReposicion::class, 'updateStockBotiquin']);
Route::get('medic_topico_detail', [PedidosReposicion::class, 'medicTopicoDetail']);
Route::get('pedido_detail', [PedidosReposicion::class, 'pedidoDetail2']);
Route::get('download_medicamentoreposicion', [PedidosReposicion::class, 'downloadMedicamentoreposicion']);
Route::post('update_stock_botiquin', [PedidosReposicion::class, 'updateStockBotiquinMasivo']);


});