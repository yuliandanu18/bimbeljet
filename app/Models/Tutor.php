<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tutor extends Model {
    protected $fillable = ['user_id','skills','hourly_rate','active'];
    protected $casts = ['skills'=>'array','active'=>'boolean'];
}
