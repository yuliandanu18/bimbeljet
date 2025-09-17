<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Package;
class PackageController extends Controller {
  public function index(){ $packages = Package::latest()->paginate(20); return view('packages.index', compact('packages')); }
  public function create(){ return view('packages.create'); }
  public function store(Request $r){
    $data = $r->validate(['name'=>'required','subject'=>'required','meetings'=>'required|integer','minutes_per_meeting'=>'required|integer','price'=>'required|integer','allow_installment'=>'boolean','branch_id'=>'required|integer']);
    Package::create($data);
    return redirect()->route('packages.index')->with('ok','Paket dibuat');
  }
}
