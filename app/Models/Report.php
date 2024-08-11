<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'title',
        'sei',
        'mei',
        'category',
        'content',
        'url',
        'image_path',
        'is_release',
        'user_id'
    ];

    public function submissonReport($requestBody) {
        $params = [
            ":title" => $requestBody["title"],
            ":sei" => $requestBody["sei"],
            ":mei" => $requestBody["mei"],
            ":category" => $requestBody["category"],
            ":content" => $requestBody["content"],
            ":url" => $requestBody["url"],
            ":image_path" => $requestBody["image_path"],
            ":is_release" => $requestBody["is_release"],
            ":user_id" => $requestBody["user_id"]
        ];

        $query = "INSERT INTO reports (
                    title,
                    sei,
                    mei,
                    category,
                    content,
                    url,
                    image_path,
                    is_release,
                    user_id
                ) 
                VALUES (
                    :title,
                    :sei,
                    :mei,
                    :category,
                    :content,
                    :url,
                    :image_path,
                    :is_release,
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

    public function updateReport($requestBody) {
        $params = [
            ":id" => $requestBody["id"],
            ":title" => $requestBody["title"],
            ":sei" => $requestBody["sei"],
            ":mei" => $requestBody["mei"],
            ":category" => $requestBody["category"],
            ":content" => $requestBody["content"],
            ":url" => $requestBody["url"],
            ":image_path" => $requestBody["image_path"],
            ":is_release" => $requestBody["is_release"]
        ];

        $query = "UPDATE reports 
                SET 
                    title = :title,
                    sei = :sei,
                    mei = :mei,
                    category = :category,
                    content = :content,
                    url = :url,
                    image_path = :image_path,
                    is_release = :is_release 
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

    public function deleteReport($report_id) {
        $params = [
            ":report_id" => $report_id
        ];

        $query = "DELETE FROM 
                    reports 
                WHERE 
                    id = :report_id
                ";

        try {
            DB::delete($query,$params);
            return true;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getReportList($page,$user_id,$titleSearch,$categorySearch,$userType) {
        //動的クエリ　共通項を先に変数宣言と代入しておく
        $reportsDisplayLimit = 10;
        $offset = (intval($page)-1) * $reportsDisplayLimit;

        $addQuery = [];
        $params = [];

        $query = "SELECT 
                    id,
                    title,
                    sei,
                    mei,
                    category,
                    content,
                    url,
                    image_path 
                FROM 
                    reports 
                ";
        
        if($userType == "report_owner") {
            array_push($addQuery, "user_id = :user_id");
            $params[":user_id"] = $user_id;
        }

        if(!is_null($titleSearch)) {
            array_push($addQuery, "title = :titleSearch");
            $params[":titleSearch"] = $titleSearch;
        }

        if(!is_null($categorySearch)) {
            array_push($addQuery, "category = :categorySearch");
            $params[":categorySearch"] = $categorySearch;
        }

        if(count($addQuery) > 0) {
            $query .= " WHERE " . implode(" AND ", $addQuery);
        }

        try {
            $reportList = DB::select("$query LIMIT $reportsDisplayLimit OFFSET $offset",$params);
            return $reportList;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getReport($report_id) {
        $params = [
            ":report_id" => $report_id
        ];

        $query = "SELECT 
                    id,
                    title,
                    sei,
                    mei,
                    category,
                    content,
                    url,
                    image_path 
                FROM 
                    reports 
                WHERE 
                    id = :report_id
                ";

        try {
            $report = DB::select($query,$params);
            return $report[0];
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getReportSize($user_id,$titleSearch,$categorySearch,$userType) {
        $reportDisplayLimit = 10;
    
        $addQuery = [];
        $params = [];

        $query = "SELECT 
                    count(*) AS record 
                FROM 
                    reports 
                ";

        if($userType == "report_owner") {
            array_push($addQuery, "user_id = :user_id");
            $params[":user_id"] = $user_id;
        }

        if(!is_null($titleSearch)) {
            array_push($addQuery, "title = :titleSearch");
            $params[":titleSearch"] = $titleSearch;
        }

        if(!is_null($categorySearch)) {
            array_push($addQuery, "category = :categorySearch");
            $params[":categorySearch"] = $categorySearch;
        }

        if(count($addQuery) > 0) {
            $query .= " WHERE " . implode(" AND ", $addQuery);
        }

        try {
            $reportCount = DB::select($query,$params);
            return floor($reportCount[0]->record/$reportDisplayLimit)+1;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function getAllReportList($user_id,$userType) {
        $addQuery = [];
        $params = [];

        $query = "SELECT 
                    id,
                    title,
                    sei,
                    mei,
                    category,
                    content,
                    url,
                    image_path 
                FROM 
                    reports 
                ";
        
        if($userType == "report_owner") {
            array_push($addQuery, "user_id = :user_id");
            $params[":user_id"] = $user_id;
        }

        if(count($addQuery) > 0) {
            $query .= " WHERE " . implode(" AND ", $addQuery);
        }

        try {
            $reportList = DB::select($query,$params);
            return $reportList;
        } catch (Exception $e) {
            Log::info($e);
            return false;
        }
    }
}
