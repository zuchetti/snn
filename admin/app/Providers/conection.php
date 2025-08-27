<?php // Code in app/Traits/MyTrait.php

namespace App\Providers;
trait conection
{
  
    //private $server = "http://54.188.13.176/sanna/sannapp/adm_services/public/";//login
    //private $server2 = "http://54.188.13.176/sanna/sannapp/services/public/";///servicios
    private $server = "https://localhost:8002/sanna/adm_services/public/";//login
    private $server2 = "https://localhost:8002/sanna/adm_services/public/";///servicios
    //private $server = "http://localhost:6060/";//login
    //////////GET JSON ////////////
    public function getJson($url,$data) {
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
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 15,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
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
        //return $header;
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
        
        // exit($content);
        $response= json_decode($content);
       
    //    exit(json_encode($response));
        if($response->status==401){
            return redirect('/');
        }else{
            return($response);
        }  

        /*$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_HTTPHEADER,  array("Content-Type: application/json",
              "Authorization: Bearer ".$accesstoken));
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($ch);
        curl_close($ch);
        $repsonseArray = json_decode($response);
        return $repsonseArray;*/
    } 

    public function getServicesGET($url,$data,$accesstoken) {
        set_time_limit(0);
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

    
   

}