<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{ClassRoom, Package, Tutor};

class ClassController extends Controller {
  public function index(){ $classes = ClassRoom::latest()->paginate(20); return view('classes.index', compact('classes')); }
  public function create(){ $packages = Package::all(); $tutors = Tutor::all(); return view('classes.create', compact('packages','tutors')); }
  public function store(Request $r){
    $data = $r->validate([
      'code'=>'required|unique:classes,code',
      'name'=>'required',
      'type'=>'required|in:regular,private',
      'subject'=>'required',
      'capacity'=>'required|integer',
      'branch_id'=>'required|integer',
      'room'=>'nullable',
      'online_link'=>'nullable|url',
      'package_id'=>'nullable|integer',
      'tutor_id'=>'nullable|integer',
      'start_date'=>'required|date'
    ]);
    ClassRoom::create($data);
    return redirect()->route('classes.index')->with('ok','Kelas dibuat');
  }
}
