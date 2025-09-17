<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ClassSchedule extends Model {
    protected $fillable = ['class_id','weekday','start_time','end_time'];
    public function classRoom(){ return $this->belongsTo(ClassRoom::class, 'class_id'); }
}
