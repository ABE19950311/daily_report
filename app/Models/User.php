<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isRegisterUser($user,$password) {
        $params = [
            "name" => $user,
            "password" => $password
        ];

        try {
            DB::insert("insert into users (name,password) values (:name,:password)",$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function loginCheck($user,$password) {
        $params = [
            "name" => $user,
            "password" => $password
        ];

        try {
            $res = DB::select("select name from users where name=:name and password=:password",$params);
            if(count($res)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function generateToken() {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    public function setSessionToken($user) {
        try {
            $token = $this->generateToken();
            Redis::set($token, $user);
            return $token;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getToken($token) {
        try {
            $res = Redis::get($token);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteToken($token) {
        try {
            Redis::del($token);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getLoginUserId($token) {
        $user = $this->getToken($token);

        $params = [
            ":name"=>$user
        ];

        try {
            $user_id = DB::select("select id from users where name=:name",$params);
            if(!empty($user_id)) {
                return $user_id[0]->id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
