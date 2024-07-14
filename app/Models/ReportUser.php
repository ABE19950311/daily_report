<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Report;

class ReportUser extends Model
{
    use HasFactory;

    protected $table = 'report_user';

    protected $fillable = [
        'report_id',
        'user_id'
    ];

    public function setRecordUserReportShow($user_id,$report_id) {
        $params = [
            ":report_id" => $report_id,
            ":user_id" => $user_id
        ];

        $query = "INSERT INTO report_user (
                    report_id,
                    user_id
                ) 
                VALUES (
                    :report_id,
                    :user_id
                )
                ";

        try {
            // \Log::info("Attempting to insert report_user record for user_id: $user_id and report_id: $report_id");
            DB::insert($query,$params);
            return true;
        } catch (Exception $e) {
            \Log::info($e);
            return false;
        }
    }

    public function getUserRankList() {

        $query = "SELECT 
                    COUNT(report_user.report_id) AS report_rank, 
                    report_user.report_id,
                    reports.title,
                    reports.category
                FROM 
                    report_user 
                INNER JOIN 
                    reports ON report_user.report_id = reports.id
                WHERE 
                    reports.is_release = 1
                GROUP BY 
                    report_user.report_id
                ORDER BY
                    report_rank DESC
                ";

        try {
            $rankList = DB::select($query);
            \Log::info($rankList);
            return $rankList;
        } catch (Exception $e) {
            \Log::info($e);
            return false;
        }
    }

}
