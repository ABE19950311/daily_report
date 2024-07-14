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

        $query = "INSERT INTO notifications (
                    address,
                    user_id
                ) 
                VALUES (
                    :address,
                    :user_id
                )
                ";

        try {
            DB::insert($query,$params);
            return true;
        } catch (Exception $e) {
            \Log::info($e);
            return false;
        }
    }

    public function getAddress($user_id) {
        $params = [
            ":user_id" => $user_id
        ];

        $query = "SELECT 
                    address 
                FROM 
                    notifications 
                WHERE 
                    user_id = :user_id
                ";

        try {
            $address = DB::select($query,$params);
            if(!empty($address)) {
                return $address;
            } else {
                return false;
            }
        } catch (Exception $e) {
            \Log::info($e);
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
