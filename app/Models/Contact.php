<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Exception;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'address',
        'contact',
        'user_id'
    ];

    public function isRegisterContact($requestBody) {
        $params = [
            ":name" => $requestBody["name"],
            ":address" => Crypt::encryptString($requestBody["address"]),
            ":contact" => Crypt::encryptString($requestBody["contact"]),
            ":user_id" => $requestBody["user_id"]
        ];

        $query = "INSERT INTO contacts (
                    name,
                    address,
                    contact,
                    user_id
                )
                VALUES (
                    :name,
                    :address,
                    :contact,
                    :user_id
                )
                ";

        try {
            DB::insert($query,$params);
            return true;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }
}
