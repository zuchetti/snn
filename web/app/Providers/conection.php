<?php // Code in app/Traits/MyTrait.php

namespace App\Providers;
trait conection
{
  
    private $server = "https://racso.doctormas.com.pe/sanna/services/public/";//login
    private $server2 = "https://racso.doctormas.com.pe/sanna/services/public/";///servicios


    // private $server = "https://200.88.199.90:8002/sanna/services83/public/";//login
    // private $server2 = "https://200.88.199.90:8002/sanna/services83/public/";///servicios
 
    //////////GET JSON ////////////
    public function getJson($url,$data) {
        set_time_limit(0);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
       
        $repsonseArray = json_decode($response);
        
        return $repsonseArray;
    } 

//     public function getServicesPrueba($url, $credentials) {
//         set_time_limit(0);

//             $header_ = [
//                 'Content-Type: application/json',
//                 'Accept: application/json'
//             ];
        
//         $jsonData = json_encode($credentials);

//         $options = array(
//             CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_HEADER         => false,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_ENCODING       => "",
//         CURLOPT_AUTOREFERER    => true,
//         CURLOPT_CONNECTTIMEOUT => 120,
//         CURLOPT_TIMEOUT        => 120,
//         CURLOPT_MAXREDIRS      => 10,
        
//         // --- LA SOLUCIÓN MÁS IMPORTANTE ---
//         // Añade un User-Agent para que el WAF no te bloquee.
//         // Puedes usar el de Postman o el de un navegador.
//         CURLOPT_USERAGENT      => 'PostmanRuntime/7.29.2',
//         // Alternativa: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36'

//         CURLOPT_SSL_VERIFYPEER => false,
//         CURLOPT_SSL_VERIFYHOST => false,
//         CURLOPT_POSTFIELDS     => $jsonData,
//         CURLOPT_HTTPHEADER     => $header_
//     );
    
//      $ch  = curl_init( $url );
//         curl_setopt_array( $ch, $options );
//         $content = curl_exec( $ch );
//         $err = curl_errno( $ch );
//         $errmsg  = curl_error( $ch );
//         $header  = curl_getinfo( $ch );
//         curl_close( $ch );
//         $header['errno']   = $err;
//         $header['errmsg']  = $errmsg;
//         $header['content'] = $content;
//         // exit(json_encode($content));
//     // Ahora intenta decodificar la respuesta
//     $response = json_decode($content);

//     // exit(json_encode($response));

//     // Si la respuesta sigue siendo HTML, json_decode devolverá null.
//     if ($response === null) {
//         // El bloqueo persiste, devuelve el HTML para poder verlo.
//         return $content;
//     }

//     return $response; 
// }

  
    public function getServicesPrueba($url,$data) { 
        set_time_limit(0);
        $header_=["Content-type:application/json"];
        $data_=$data;
        $url_=$url;
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 1000,      // timeout on connect
            CURLOPT_TIMEOUT        => 1000,      // timeout on response
            CURLOPT_MAXREDIRS      => 1000,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert check for localhost
            CURLOPT_SSL_VERIFYHOST=> false,
            CURLOPT_POSTFIELDS =>$data_,
            CURLOPT_HTTPHEADER =>$header_
         );
        
        $ch  = curl_init( $url_ );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        
        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        exit(json_encode($content));
        $response= json_decode($content);
        
        if($response->status==401){
            return redirect('/');
        }else{
            return($response);
        }      
    }

    public function getServices($url,$data,$accesstoken) {   
        set_time_limit(0);
        $header_=["Content-type:application/json","Authorization: Bearer ".$accesstoken];
        $data_=$data;
        $url_=$url;
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 0,      // timeout on connect
            CURLOPT_TIMEOUT        => 400,      // timeout on response
            CURLOPT_MAXREDIRS      => 1000,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert check for localhost
            CURLOPT_SSL_VERIFYHOST=> false,
            CURLOPT_POSTFIELDS =>$data_,
            CURLOPT_HTTPHEADER =>$header_
         );
        
        $ch  = curl_init( $url_ );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        
        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        
        $response= json_decode($content);
        // exit(json_encode($response));
        

        if(isset($response->status)){
            if( $response->status==401){
                return redirect('/');
            }else{
                return($response);
            } 
        }else{
            return($response);
        }
            
          /*
            //return $header;
        if($response->status==401){
            return redirect('/');
        }else{
            return($response);
        } */
    } 

    public function getServicesGET($url,$data,$accesstoken) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_HTTPHEADER,  array("Content-Type: application/json",
              "Authorization: Bearer ".$accesstoken));
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($ch);
        curl_close($ch);
        $repsonseArray = json_decode($response);
        return $repsonseArray;
    } 

    public function getPdf($url,$data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1000);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_HTTPHEADER,  array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($ch);
        curl_close($ch);
        $repsonseArray = json_decode($response);
        return $repsonseArray;
    } 


    
   

}