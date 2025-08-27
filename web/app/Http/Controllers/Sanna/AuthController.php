<?php

namespace App\Http\Controllers\Sanna;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 
use Redirect;
use \stdClass;

class AuthController extends Controller
{
    //
    use conection;

    //login
    public function login(Request $request){
     
        $request->session()->flush();
        
        $data =['num_doc'=>$request['dni'],'password'=>$request['password']];
        $url = $this->server2.'api/login';
        
        $responseServer = $this->getServicesPrueba($url,json_encode($data));
        
        // exit(json_encode($responseServer));

       if($responseServer->status == 200){
            //sesion user
            
            //exit(json_encode($responseServer));
            $request->session()->put(['medico'=>$responseServer]);
            $_session = session('medico');

            return json_encode(array('status'=>200,'url'=>'validate','password'=>session('medico')->data[0]->password,'google_secret'=>session('medico')->data[0]->info[0]->google2fa_secret));


        }else{

            return json_encode($responseServer);

        }
    }


    public function login2(Request $request){
        
        $request->session()->flush();
     
        $data =['num_doc'=>$request['dni'],'password'=>$request['password']];
        
        $url = $this->server2.'api/login';
        
        $responseServer = $this->getServicesPrueba($url,json_encode($data));
        
        

       if($responseServer->status == 200){
            //sesion user
            
            //exit(json_encode($responseServer));
            $request->session()->put(['medico'=>$responseServer]);
            $_session = session('medico');

            return json_encode(array('status'=>200,'url'=>'validate','password'=>session('medico')->data[0]->password,'google_secret'=>session('medico')->data[0]->info[0]->google2fa_secret));


        }else{

            return json_encode($responseServer);

        }
    }

    function loginview(Request $request){
       
        return view('login/login');
    }
    

    //changePassword
    public function changePassword(Request $request){
        return view('login/changePassword',['dni'=>$request['dni']]);
    }

    //confirmCode
    public function confirmCode(Request $request){
        return view('login/confirmCode',['dni'=>$request['dni']]);
    }


    //createPassword
    public function createPassword(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['num_doc'=>$request['dni'], 'so'=>2,'lat'=>$lat,'long'=>$long,'password'=>$request['password']];
        $url = $this->server2.'api/create_pass';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

     //updatePassword
     public function updatePassword(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['num_doc'=>$request['dni'],'codigo'=>$request['codigo'],'so'=>2,'lat'=>$lat,'long'=>$long,'password'=>$request['password']];
        $url = $this->server2.'api/update_pass';
        $result = $this->getServicesPrueba($url,json_encode($data));
        return json_encode($result);
    }


    
    //getCode
    

     //validateCode
     //getCode
     public function getCode(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['num_doc'=>$request['dni'],'lat'=>$lat,'long'=>$long,'so'=>2];
        $url = $this->server2.'api/get_codigo';
        $result = $this->getServicesPrueba($url,json_encode($data));
        return json_encode($result);
    }

    public function validarCodigo(Request $request){
        return view('login/validarCodigo',['dni'=>$request['dni']]);

    }

    public function getQr(Request $request){
        $data=['token'=>$request['token']];
        $url = $this->server2.'api/generate_qrcode';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    public function googleauth(Request $request){
        $info=json_decode($this->getQr($request));
        
        $url='otpauth://totp/SANNA2:'.$info->data->companyEmail.'?secret='.$info->data->secretKey.'&issuer='.$info->data->companyName.'';
        //exit(json_encode($url));
        return view('login/googleauth',['info'=>$info,'url'=>$url]);

    }

     //validateCode
     public function validateCode(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,
        'long'=>$long,'key'=>$request['token']];
        //exit(json_encode($data));
        $url = $this->server2.'api/validate_key';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        
        if($result->status == 200){

        
            return redirect()->route('topico');
        }else{

            return redirect('https://racso.doctormas.com.pe/sanna/web/public/')->withErrors($result->message);

        }

    }

    public function validateCodeFirst(Request $request){
        
            $data=['key'=>$request['token'],'secretKey'=>$request['keySecret']];
            
            $url = $this->server2.'api/first_configuration';
            $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
            //exit(json_encode($result));
            if($result->status == 200){

                $data=['so'=>2,'key'=>$request['token']];
                //exit(json_encode($data));
                $url = $this->server2.'api/validate_key';
                $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);

                if($result->status == 200){

                    $request->session()->put(['state'=>1]);
                    $_session = session('state');

                    return redirect()->route('topico');

                }else{
        
                    return redirect('https://racso.doctormas.com.pe/sanna/web/public/')->withErrors($result->message);
        
                }
                
            }else{
                return redirect('https://racso.doctormas.com.pe/sanna/web/public/')->withErrors($result->message);
            }

        
        
       

    }

 
    

    //////logout///////////
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('https://racso.doctormas.com.pe/sanna/web/public/');
    }


}
