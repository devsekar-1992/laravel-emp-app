<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use DB;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table
     */
    protected $table='emp_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'primary_number',
        'password',
        'department_id'
    ];
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Authenticate the users
     *
     * @return array
     */
    public static function authUser($request){
        $authenticatedUser=User::where('email',$request['userName'])->first();
        if(!$authenticatedUser || !Hash::check($request['password'], $authenticatedUser->password)){
            return response([
                'message'=>['These credentials do not match']
            ],401);
        } else {
            $token=$authenticatedUser->createToken('my-app-token')->plainTextToken;
            $response=[
                'user'=>$authenticatedUser,
                'token'=>$token
            ];
            return response($response,201);
        }
    }
    /**
     * Store user information
     *
     * @return array
     */
    public static function saveUser($request) {

        $current_date_time = Carbon::now()->toDateTimeString();
        $request['created_at']=$current_date_time;
        $request['updated_at']=$current_date_time;
        $insertedId=DB::table('emp_users')->insertGetId($request);
        return [
            'status'=>200,
            'id'=>$insertedId
        ];
    }
}
