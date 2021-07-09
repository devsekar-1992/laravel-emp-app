<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use App\Models\ValorProjects;

class TaskVersionModel extends Model
{
    use HasFactory;

    /**
     * Table
     */
    protected $table='emp_task_version';

    /**
     * Save the task version
     */
    public static function saveTaskVersion($versionInfo) {
        $isVersionSave=false;
        $current_date_time = Carbon::now()->toDateTimeString();
        $projectReferArr=ValorProjects::where('valor_project_id','=',$versionInfo['valor_project_id'])->select('id')->get()->toArray();
        if(count($projectReferArr)>0){
        $versionInfo['valor_project_id']=$projectReferArr['0']['id'];
        $versionInfo['created_at']=$current_date_time;
        $versionInfo['updated_at']=$current_date_time;
        $versionId=DB::table('emp_task_version')->insertGetId($versionInfo);
        $isVersionSave=true;
        }
        return [
            'status'=>$isVersionSave,
            'id'=>$versionId
        ];
    }
    /**
     * Get Project Information
     *
     * @return model
     */
    public function projectInfo() {
        return $this->belongsTo(ValorProjects::class,'valor_project_id','id');
    }
}
