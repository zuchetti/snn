<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 
use DB;
use Redirect;
use \stdClass;

class AuthController extends Controller
{
    //
    use conection;

    //login
    public function login(Request $request){
        $request->session()->flush();
     
        $data =["dni"=>$request['dni'],'password'=>$request['password']];
        $url = $this->server2.'api/login';
        $responseServer = ($this->getServicesPrueba($url,json_encode($data)));  
        // exit(json_encode($responseServer));
        if($responseServer->status == 200){

            //sesion user
            $request->session()->put(['usuario'=>$responseServer]);
            $_session = session('usuario');
            $token=session('usuario')->data[0]->token;

            //session menu
            $data =["idrol"=>$responseServer->data[0]->info[0]->idrol];
            $url = $this->server2.'api/get_modules';
            $responseServer = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
            $request->session()->put(['menu'=>$responseServer]);
            $_session = session('menu');
            

            return json_encode(array('status'=>200,'url'=>'validate','google_secret'=>session('usuario')->data[0]->info[0]->google2fa_secret));

        
            
          
        }else{

            return json_encode($responseServer);

        }
    }


    public function getQr(Request $request){
        $data=[];
        //exit(json_encode(session('usuario')->data[0]->token));
        $url = $this->server2.'api/generate_qrcode';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        return json_encode($result);
    }

    public function googleauth(Request $request){
        $info=json_decode($this->getQr($request));
        //exit(json_encode($info));
        $url='otpauth://totp/SANNA2:'.$info->data->companyEmail.'?secret='.$info->data->secretKey.'&issuer='.$info->data->companyName.'';
        //exit(json_encode($url));
        return view('login/googleauth',['info'=>$info,'url'=>$url]);

    }

    public function prueba2(Request $request){
        $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8090/dashboard/sanna/adm_services/public/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "dni":"73043761",
                "password":"123456789"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            exit();
            /*
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/json',
                    'content' => '{
                        "dni":"73043761",
                        "password":"123456789"
                    }'
                )
            );

            $context  = stream_context_create($opts);

            $result = file_get_contents('http://localhost:8090/dashboard/sanna/adm_services/public/api/login', false, $context);
            echo($result);*/

        $tabla=DB::select("SELECT * FROM usuarios");
        echo json_encode($tabla);
    }

    public function prueba(Request $request){
        $url='http://localhost:8090/dashboard/sanna/adm_services/public/api/login';
        $data=json_encode(["dni"=>"73043761", "password"=>"12456789"]);
        $header=[];
        return json_encode( $this->getServicesInfo($url,$data,$header));
        
    }

    function getServicesInfo($url_,$data_,$header_){
        $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 15,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => true,     // Disabled SSL Cert check for localhost
        CURLOPT_POSTFIELDS =>$data_,
        CURLOPT_HTTPHEADER =>$header_
        );
    
        $ch      = curl_init( $url_ );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
    
        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        
        return $header;
        if($header['http_code']==200){
            return $header['content'];
        }else{
            $arr['status']='100';
            $arr['mensaje']= 'Error de conexion: Externo';
            
            exit(json_encode($arr)) ;
        }
    }


    
    public function validarCodigo(Request $request){
        return view('login/validarCodigo',['dni'=>$request['dni']]);

    }

     //validateCode
     public function validateCode(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,
        'long'=>$long,'key'=>$request['token']];
        //exit(json_encode($data));
        $url = $this->server2.'api/validate_key';
        $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
        
        if($result->status == 200){

        
            return redirect()->route('dashboard');
        }else{

            return redirect('/')->withErrors($result->message);

        }

    }

    public function validateCodeFirst(Request $request){
        
            $data=['key'=>$request['token'],'secretKey'=>$request['keySecret']];
            
            $url = $this->server2.'api/first_configuration';
            $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);
            //exit(json_encode($result));
            if($result->status == 200){

                $data=['so'=>2,'key'=>$request['token']];
                //exit(json_encode($data));
                $url = $this->server2.'api/validate_key';
                $result = $this->getServices($url,json_encode($data),session('usuario')->data[0]->token);

                if($result->status == 200){

                    $request->session()->put(['state'=>1]);
                    $_session = session('state');

                    return redirect()->route('dashboard');


                }else{
        
                    return Redirect::back()->withErrors($result->message);
        
                }
                
            }else{
                return Redirect::back()->withErrors($result->message);
            }

        
        
       

    }

 

    //////logout///////////
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('https://racso.doctormas.com.pe/sanna/admin/public/');
    }


}
