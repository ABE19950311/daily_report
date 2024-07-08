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

        $query = "insert into users (name,password,group_id) values (:name,:password,:group_id)";

        try {
            DB::insert($query,$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function exsistUserCheck($user,$password,$userType) {
        $params = [
            ":name" => $user
        ];

        $query = "select users.password,`groups`.group 
                    from users inner join `groups` on users.group_id=`groups`.id
                    where name=:name";

        try {
            $user = DB::select($query,$params);
            \Log::info($user);
            // /admin/login(admin権限)でログインできるユーザならgroupにadminが返るはず。report_owner等も同様
            if(count($user) && Hash::check($password,$user[0]->password) && $user[0]->group==$userType) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            \Log::info($e);
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
            \Log::info($e);
            return false;
        }
    }

    public function getToken($token) {
        try {
            $res = Redis::get($token);
            return $res;
        } catch (Exception $e) {
            \Log::info($e);
            return false;
        }
    }

    public function getUserType($token) {
        try {
            $res = Redis::get($token . "userType");
            return $res;
        } catch (Exception $e) {
            \Log::info($e);
            return false;
        }
    }

    public function deleteSession($token) {
        try {
            Redis::del($token);
            Redis::del($token . "userType");
            return true;
        } catch (Exception $e) {
            \Log::info($e);
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
            \Log::info($e);
            return false;
        }
    }

    public function validation($request) {
        $rules = array(
            'user' => 'required|max:255',
            'password' => 'required|max:255'
        );
        $validator = Validator::make($request,$rules);
        return $validator;
    }
}
