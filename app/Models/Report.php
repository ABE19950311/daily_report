<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::insert("insert into reports (title,sei,mei,category,content,url,image_path,is_release,user_id) values (:title,:sei,:mei,:category,:content,:url,:image_path,:is_release,:user_id)",$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
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

        $column = "title=:title,sei=:sei,mei=:mei,category=:category,content=:content,url=:url,image_path=:image_path,is_release=:is_release";
        $query = "id=:id";

        try {
            DB::update("UPDATE reports SET $column WHERE $query",$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteReport($report_id) {
        $query = "id=:report_id";
        $params = [
            ":report_id" => $report_id
        ];
        try {
            DB::delete("DELETE FROM reports WHERE $query",$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getReportList($page,$user_id,$titleSearch,$categorySearch) {
        //動的クエリ　共通項を先に変数宣言と代入しておく
        $reportsDisplayLimit = 10;
        $offset = (intval($page)-1) * $reportsDisplayLimit;
        $query = "select id,title,sei,mei,category,content,url,image_path from reports where user_id=:user_id";
        $params = [":user_id" => $user_id];

        if(!is_null($titleSearch)) {
            $query .= " and title=:titleSearch";
            $params[":titleSearch"] = $titleSearch;
        }

        if(!is_null($categorySearch)) {
            $query .= " and category=:categorySearch";
            $params[":categorySearch"] = $categorySearch;
        }

        try {
            $reportList = DB::select("$query LIMIT $reportsDisplayLimit OFFSET $offset",$params);
            return $reportList;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getReport($report_id) {
        $column = "id,title,sei,mei,category,content,url,image_path";
        $query = "id=:report_id";
        $params = [
            ":report_id" => $report_id
        ];

        try {
            $report = DB::select("select $column from reports where $query",$params);
            return $report[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getReportSize($user_id,$titleSearch,$categorySearch) {
        $reportDisplayLimit = 10;
    
        $query = "select count(*) as record from reports where user_id=:user_id";
        $params = [":user_id" => $user_id];

        if(!is_null($titleSearch)) {
            $query .= " and title=:titleSearch";
            $params[":titleSearch"] = $titleSearch;
        }

        if(!is_null($categorySearch)) {
            $query .= " and category=:categorySearch";
            $params[":categorySearch"] = $categorySearch;
        }

        try {
            $reportCount = DB::select($query,$params);
            return floor($reportCount[0]->record/$reportDisplayLimit)+1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
