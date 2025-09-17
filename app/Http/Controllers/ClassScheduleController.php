<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{ClassRoom, ClassSchedule};

class ClassScheduleController extends Controller {
  public function store(Request $r, ClassRoom $class){
    $data = $r->validate(['weekday'=>'required|integer|min:0|max:6','start_time'=>'required','end_time'=>'required']);
    $class->schedules()->create($data);
    return back()->with('ok','Jadwal ditambah');
  }
}
