<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use Carbon\CarbonImmutable;

class CalendarController extends Controller {
  public function index(Request $r) {
    $week = CarbonImmutable::now()->startOfWeek();
    $schedules = ClassSchedule::with('classRoom')->get();
    return view('calendar.index', compact('week','schedules'));
  }
}
