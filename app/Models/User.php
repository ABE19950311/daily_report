<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

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
        'group_id'
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

    public function isRegisterUser($user,$password,$userType) {
        $types = [
            "admin" => 1,
            "report_owner" => 2,
            "report_viewer" => 3
        ];

        $group_id = $types[$userType];

        $params = [
            ":name" => $user,
            ":password" => bcrypt($password),
            ":group_id" => $group_id
        ];

        $query = "INSERT INTO users (
                    name,
                    password,
                    group_id
                )
                VALUES (
                    :name,
                    :password,
                    :group_id
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

    public function isUpdatePassword($userId,$password) {
        $params = [
            ":id" => $userId,
            ":password" => bcrypt($password)
        ];

        $query = "UPDATE users
                SET
                    password = :password
                WHERE
                    id = :id
                ";

        try {
            DB::update($query,$params);
            return true;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function isUpdateUserName($userId,$user) {
        $params = [
            ":id" => $userId,
            ":name" => $user
        ];

        $query = "UPDATE users
                SET
                    name = :name
                WHERE
                    id = :id
                ";

        try {
            DB::update($query,$params);
            return true;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function exsistUserCheck($user,$password,$userType) {
        $params = [
            ":name" => $user
        ];

        $query = "SELECT 
                    users.password,
                    `groups`.group 
                FROM 
                    users 
                INNER JOIN 
                    `groups` ON users.group_id = `groups`.id
                WHERE 
                    name = :name
                ";

        try {
            $user = DB::select($query,$params);
            Log::info($user);
            // /admin/login(admin権限)でログインできるユーザならgroupにadminが返るはず。report_owner等も同様
            if(count($user) && Hash::check($password,$user[0]->password) && $user[0]->group==$userType) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    private function generateToken() {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    public function setSession($user,$userType) {
        try {
            $token = $this->generateToken();
            Redis::set($token, $user);
            Redis::set($token . "userType", $userType);
            return $token;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function updateUserSession($token,$user) {
        try {
            Redis::getset($token, $user);
            return true;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getUserName($token) {
        try {
            $res = Redis::get($token);
            return $res;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getUserType($token) {
        try {
            $res = Redis::get($token . "userType");
            return $res;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function deleteSession($token) {
        try {
            Redis::del($token);
            Redis::del($token . "userType");
            return true;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getLoginUserId($token) {
        $user = $this->getUserName($token);

        $params = [
            ":name"=>$user
        ];

        $query = "SELECT 
                    id 
                FROM 
                    users 
                WHERE 
                    name = :name
                ";

        try {
            $user_id = DB::select($query,$params);
            if(!empty($user_id)) {
                return $user_id[0]->id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }
}
