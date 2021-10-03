<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Ip extends Model
{
    use HasFactory;

    /**
     * Add Ip to whitelist table
     *
     * @param IpRequest
     * @return json
     */
    public static function addToWhitelist($ipRequest){
	    $status=false;
	    $currentTime=Carbon::now()->toDateTimeString();
	    $result=Ip::create([
		    'ip'=>ip2long($ipRequest['ip']),
		    'created_at'=>$currentTime,
		    'modified_at'=>$currentTime
	    ]);
	    if($result){
		    $msg='Inserted Successfully';
	    } else {
		    $msg='Ip whitelist not inserted';
	    }
	    return [
		    'status'=>$status,
		    'msg'=>$msg
	    ];
    }
    /**
     * Remove Ip from whitelist table
     *
     * @param IpRequest
     * @return json
     */
    public static function removeFromWhitelist($ipRequest){
	    $status=false;
	    $result=Ip::destroy([
		    ip2long($ipRequest['ip'])
	    ]);
	    if($result){
		    $msg='Deleted Successfully';
	    } else {
		    $msg='Ip whitelist not deleted';
	    }
	    return [
		    'status'=>$status,
		    'msg'=>$msg
	    ];
    }
}
