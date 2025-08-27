<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cache;

use Closure;
use App\Providers\conection; 

class ValidarToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    use conection; 

    public function handle($request, Closure $next)
    {

        //print_r(session('usuario'));
        
        if (session('usuario')!=null) {
            //Cache::flush();
            /*
                $token = session('usuario')->data[0]->token;
                $url_=$this->server."api/validate_token";
                $header_= array(
                    "Content-Type: application/json",
                    "Authorization: Bearer ".$token
                );
                
                $data_=[];
                $options = array(
                    CURLOPT_RETURNTRANSFER => true,     // return web page
                    CURLOPT_HEADER         => false,    // don't return headers
                    CURLOPT_FOLLOWLOCATION => true,     // follow redirects
                    CURLOPT_ENCODING       => "",       // handle all encodings
                    CURLOPT_USERAGENT      => "mapsalud",// who am i
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
                $response = curl_exec($ch);
                curl_close($ch);
                //echo $response;
                $response=json_decode($response);

                $header_=["Content-type:application/json","Authorization: Bearer ".$token];
                $data_=[];
                $url_=$this->server."api/validate_token";;
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
                    //return $header;

            if( $response->status==200) return $next($request);
            else  return redirect('/');
        */
            return $next($request);
        }else return redirect('/');
       
    }
}