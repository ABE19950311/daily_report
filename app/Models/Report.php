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
            ":user_id" => $requestBody["user_id"]
        ];

        try {
            DB::insert("insert into reports (title,sei,mei,category,content,url,image_path,user_id) values (:title,:sei,:mei,:category,:content,:url,:image_path,:user_id)",$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getReportList($page,$user_id) {

        $reportsDisplayLimit = 10;
        $offset = ($page-1) * $reportsDisplayLimit;

        $params = [
            ":user_id" => $user_id,
        ];

        try {
            $reportList = DB::select("select id,title,sei,mei,category,content,url,image_path from reports where user_id=:user_id LIMIT $reportsDisplayLimit OFFSET $offset",$params);
            return $reportList;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getReport() {
        $reportId = $_GET["reportid"];
        
        $column = "id,title,sei,mei,category,content,url,image_path";
        $query = "id=:reportId";
        $params = ["reportId"=>$reportId];

        $report = $this->mysql->dbSelect("report",$column,$query,$params);
        return $report;
    }

    public function getReportSize($user_id) {
        $reportDisplayLimit = 10;

        $params = [
            ":user_id" => $user_id,
        ];

        try {
            $reportCount = DB::select("select count(*) as record from reports where user_id=:user_id",$params);
            return floor($reportCount[0]->record/$reportDisplayLimit)+1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
