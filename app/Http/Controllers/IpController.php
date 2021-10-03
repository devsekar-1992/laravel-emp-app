<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\IpRequest;
use App\Http\Traits\ResponseTraits;
use App\Models\Ip;

class IpController extends Controller
{
	use ResponseTraits;
	/**
	 * Add ip to whitelist
	 *
	 * @param request
	 * @return json
	 */
	public function create(IpRequest $ipRequest){
		$result=Ip::addToWhitelist($ipRequest->all());
		if($result['status']){
			return $this->sendSuccessResponse(200,$result['msg']);
		}
		return $this->sendCustomMessage(500,$result['msg']);
	}
	/**
	 * Remove ip to whitelist
	 *
	 * @param request
	 * @return json
	 */
	public function destroy(IpRequest $ipRequest){
		$result=Ip::removeFromWhitelist($ipRequest->all());
		if($result['status']){
			return $this->sendSuccessResponse(200,$result['msg']);
		}
		return $this->sendCustomMessage(500,$result['msg']);
	}
}
