<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Student extends Model {
    protected $fillable = ['user_id','parent_contact','school','grade','notes','name','phone'];
}
