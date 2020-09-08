<?php


namespace App\Http\Middleware;
use Closure;

class Cors
{

  public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE,PATCH',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Authorization'                    => 'RcgkvUAAOpGckyWonLANuTAZEFtU7VkZ',
            'Access-Control-Allow-Headers'     => 'Content-Type,Authorization,X-Requested-With,origin,X-Auth-Token,Accept,Access-Control-Request-Method'

        ];

        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }

        return $response;
    }
   

}