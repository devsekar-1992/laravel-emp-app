<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Ip;
use App\Http\Traits\ResponseTraits;

class Ip
{
    use ResponseTraits;	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
	$whitelistIp=Ip::pluck('whitelist')->toArray();
	if(Arr::hasAny($whitelistIp,ip2long($request->ip()))){
        	return $next($request);
	}
	return $this->sendForbiddenResponse(__('response.403_access'));
    }
}
