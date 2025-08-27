<?php

use App\Http\Controllers\Sanna\AuthController;
use App\Http\Controllers\Sanna\RegistroAtencion\AtencionController;
use App\Http\Controllers\Sanna\DashboardController;
use App\Http\Controllers\Sanna\RegistroAtencion\RegistroAtencionController;
use App\Http\Controllers\Sanna\RegistroAtencion\HistoriaClinicaController;
use App\Http\Controllers\Sanna\RegistroAtencion\DiagnosticoController;
use App\Http\Controllers\Sanna\RegistroAtencion\RecetaMedicaController;
use App\Http\Controllers\Sanna\RegistroAtencion\ExamenController;
use App\Http\Controllers\Sanna\RegistroAtencion\DescansoMedicoController;
use App\Http\Controllers\Sanna\HistoriasClinicas\HistoriasClinicasController;
use App\Http\Controllers\Sanna\StockMedicamentos\StockMedicamentosController;
use App\Http\Controllers\Sanna\BaseAtencionesController;
use App\Http\Controllers\Sanna\RegistroAtencion\UbigeoController;
use App\Http\Controllers\Sanna\RegistroAtencion\SitedsController;

Route::get('/', [AuthController::class, 'loginview']);

Route::post('login', [AuthController::class, 'login']);
Route::get('login_v', [AuthController::class, 'login2']);
Route::get('changePassword', [AuthController::class, 'changePassword']);
Route::get('createPassword', [AuthController::class, 'createPassword']);
Route::get('getCode', [AuthController::class, 'getCode']);
Route::get('confirmCode', [AuthController::class, 'confirmCode']);
Route::get('updatePassword', [AuthController::class, 'updatePassword']);

Route::view('forgetPassword', 'login.forgetPassword');

Route::get('validate', [AuthController::class, 'validarCodigo']);

Route::post('validate_code', [AuthController::class, 'validateCode']);

Route::middleware(['validarToken'])->group(function () {
    Route::view('finish_attention', 'registroAtencion.atencion.index');
    
    Route::get('filiacion', [AtencionController::class, 'filiacion']);
    Route::get('receta', [AtencionController::class, 'receta']);
    Route::get('atencion', [AtencionController::class, 'atencion']);
    Route::get('descanso', [AtencionController::class, 'descanso']);
    Route::get('examenes', [AtencionController::class, 'examenes']);
    Route::get('registrar_attention', [AtencionController::class, 'registrarAttention']);
    Route::get('all_attentions', [AtencionController::class, 'allAttentions']);

    Route::get('autentication_googleauth', [AuthController::class, 'googleauth']);
    Route::post('validate_code_first', [AuthController::class, 'validateCodeFirst']);

    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('topico', [DashboardController::class, 'topico'])->name('topico');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('getPaciente', [SitedsController::class, 'getPaciente']);

    Route::get('pdfRecetaMedica', [HistoriasClinicasController::class, 'pdfRecetaMedica']);

    Route::get('ConsultaNumeroAutorizacion', [RegistroAtencionController::class, 'ConsultaNumeroAutorizacion']);
    Route::get('newAtencion', [RegistroAtencionController::class, 'newAtencion']);
    Route::post('sendFirma', [RegistroAtencionController::class, 'sendFirma']);
    Route::get('infoGeneral', [RegistroAtencionController::class, 'infoGeneral']);
    Route::get('savedPacienteCortesia', [RegistroAtencionController::class, 'savedPacienteCortesia']);
    Route::get('paciente_cortesia', [RegistroAtencionController::class, 'PacienteCortesia']);
    Route::get('PacienteCortesia_iafas', [RegistroAtencionController::class, 'PacienteCortesiaIafas']);
    Route::get('historyClinic', [HistoriaClinicaController::class, 'historyClinic']);
    Route::get('CreateHistory', [HistoriaClinicaController::class, 'CreateHistory']);
    Route::get('save_history_session', [HistoriaClinicaController::class, 'saveHistorySession']);
    Route::get('historiaClinicapdf', [HistoriaClinicaController::class, 'historiaClinicapdf']);
    Route::get('diagnostico', [DiagnosticoController::class, 'diagnostico']);
    Route::get('CreateHojaAmbulatoria', [DiagnosticoController::class, 'CreateHojaAmbulatoria']);
    Route::get('getDiagnosticos', [DiagnosticoController::class, 'getDiagnosticos']);
    Route::get('diagnosticoPdf', [DiagnosticoController::class, 'diagnosticoPdf']);
    Route::get('save_diagnostic_session', [DiagnosticoController::class, 'saveDiagnosticSession']);
    Route::get('recetaMedica', [RecetaMedicaController::class, 'recetaMedica']);
    Route::get('CreateRecetaMconsulta', [RecetaMedicaController::class, 'CreateRecetaMconsulta']);
    Route::get('addMedicament', [RecetaMedicaController::class, 'addMedicament']);
    Route::get('updateTableMedicament', [RecetaMedicaController::class, 'updateTableMedicament']);
    Route::get('deletetableMedicament', [RecetaMedicaController::class, 'deletetableMedicament']);
    Route::get('save_receta_session', [RecetaMedicaController::class, 'saveRecetaSession']);
    Route::get('table_session_medicamentos', [RecetaMedicaController::class, 'table_session_medicamentos']);
    Route::get('getRecetaPDF', [RecetaMedicaController::class, 'getRecetaPDF']);
    Route::get('examenesAuxiliares', [ExamenController::class, 'examenesAuxiliares']);
    Route::get('CreateExamenConsulta', [ExamenController::class, 'CreateExamenConsulta']);
    Route::get('getExamenImgTopico', [ExamenController::class, 'getExamenImgTopico']);
    Route::get('getcie10Session', [ExamenController::class, 'getcie10Session']);
    Route::get('getExamenLabTopico', [ExamenController::class, 'getExamenLabTopico']);
    Route::get('examenesAuxiliarespdf', [ExamenController::class, 'getExamenPDF']);
    Route::get('save_examenes_session', [ExamenController::class, 'saveExamenesSession']);
    Route::get('descansoMedico', [DescansoMedicoController::class, 'descansoMedico']);
    Route::get('CreateDescansoMedicoConsulta', [DescansoMedicoController::class, 'CreateDescansoMedicoConsulta']);
    Route::get('descansoMedicopdf', [DescansoMedicoController::class, 'getDescansoPDF']);
    Route::get('save_descanso_session', [DescansoMedicoController::class, 'saveDescansoSession']);
    
    Route::view('historiasClinicas', 'historiasClinicas.inicio');
Route::post('getHistoriasClinicasTable', [HistoriasClinicasController::class, 'getHistoriasClinicasTable']);
Route::post('detalleHistoriaClinicaTable', [HistoriasClinicasController::class, 'detalleHistoriaClinicaTable']);
Route::get('HistoryClinicDetail', [HistoriasClinicasController::class, 'HistoryClinicDetail']);
Route::get('detalleaAtencion', [HistoriasClinicasController::class, 'detalleaAtencion']);
Route::get('descargaHistoria', [HistoriasClinicasController::class, 'descargaHistoria']);
Route::get('pdf_orden_receta_generate', [HistoriasClinicasController::class, 'pdfOrdenGenerate']);

Route::view('stockMedicamentos', 'stockMedicamentos.inicio');
Route::view('reposicionMedicamentos', 'stockMedicamentos.reposicion');
Route::view('solicitudMedicament', 'stockMedicamentos.solicitud');
Route::post('getMedicTopicoTable', [StockMedicamentosController::class, 'getMedicTopicoTable']);
Route::post('reposicionMedicamentosTable', [StockMedicamentosController::class, 'reposicionMedicamentosTable']);
Route::post('stockActual', [StockMedicamentosController::class, 'stockActual']);
Route::post('getSolicitudrepodetail', [StockMedicamentosController::class, 'getSolicitudrepodetail']);
Route::get('nuevaSolicitud', [StockMedicamentosController::class, 'nuevaSolicitud']);
Route::get('resposicionDetail', [StockMedicamentosController::class, 'resposicionDetail']);

Route::view('basedeAtenciones', 'basedeAtenciones.inicio');
Route::post('get_baseatencion_tabla', [BaseAtencionesController::class, 'getBaseatencionTabla']);
Route::get('detail_baseatencion', [BaseAtencionesController::class, 'detailBaseatencion']);

Route::get('get_pais', [UbigeoController::class, 'getPais']);
Route::get('get_provincia', [UbigeoController::class, 'getProvincia']);
Route::get('get_distrito', [UbigeoController::class, 'getDistrito']);

});

Route::get('/clear-cache', function() {

    $exitCode = Artisan::call('config:clear');

    $exitCode = Artisan::call('cache:clear');

    $exitCode = Artisan::call('route:clear');

    $exitCode = Artisan::call('view:clear');

    $exitCode = Artisan::call('optimize');

    

    return 'DONE3'; //Return anything

});
// Route::get('/sanna/web/public/{any?}', function () {
//     return redirect('https://racso.com.pe');
// })->where('any', '.*');