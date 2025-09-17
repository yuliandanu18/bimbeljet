<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model {
    use SoftDeletes;
    protected $table = 'classes';
    protected $fillable = [
        'code','name','type','subject','capacity','branch_id','room','online_link','package_id','tutor_id','start_date'
    ];

    public function schedules(){ return $this->hasMany(ClassSchedule::class, 'class_id'); }
    public function tutor(){ return $this->belongsTo(Tutor::class); }
    public function package(){ return $this->belongsTo(Package::class); }
    public function enrollments(){ return $this->hasMany(Enrollment::class, 'class_id'); }
}
