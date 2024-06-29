<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        $query = "insert into report_user (report_id,user_id) values (:report_id,:user_id)";

        try {
            \Log::info("Attempting to insert report_user record for user_id: $user_id and report_id: $report_id");
            DB::insert($query,$params);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
