<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $fillable = [
        'address',
        'user_id'
    ];

    public function isRegisterAddress($address,$user_id) {
        $params = [
            ":address" => $address,
            ":user_id" => $user_id
        ];

        try {
            DB::insert("insert into notifications (address,user_id) values (:address,:user_id)",$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAddress($user_id) {
        $params = [
            ":user_id"=>$user_id
        ];
        try {
            $address = DB::select("select address from notifications where user_id=:user_id",$params);
            if(!empty($address)) {
                return $address;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function validation($request) {
        $rules = array(
            'mailAddress' => 'required|email|max:255|unique:notifications,address'
        );
        $validator = Validator::make($request,$rules);
        return $validator;
    }
}
