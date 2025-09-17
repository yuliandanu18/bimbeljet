<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Lead, Student, Enrollment, Package, ClassRoom, Invoice};
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function index() {
        $leads = Lead::latest()->paginate(20);
        return view('leads.index', compact('leads'));
    }

    public function create() {
        return view('leads.create');
    }

    public function store(Request $r) {
        $data = $r->validate([
            'name'=>'required',
            'phone'=>'required',
            'source'=>'nullable',
            'interest_subjects'=>'nullable|array',
            'notes'=>'nullable|string'
        ]);
        $data['status'] = 'new';
        $data['owner_id'] = $r->user()->id;
        $data['branch_id'] = $r->user()->branch_id ?? 1;
        $lead = Lead::create($data);
        return redirect()->route('leads.show',$lead);
    }

    public function show(Lead $lead) {
        $packages = Package::all();
        $classes = ClassRoom::all();
        return view('leads.show', compact('lead','packages','classes'));
    }

    public function convertToEnrollment(Request $r, Lead $lead) {
        $r->validate(['class_id'=>'required|exists:classes,id','package_id'=>'required|exists:packages,id']);
        DB::transaction(function() use ($lead, $r) {
            $student = Student::firstOrCreate(['phone'=>$lead->phone], [
                'name'=>$lead->name,
                'notes'=>'from lead #'.$lead->id,
            ]);
            $enrollment = Enrollment::create([
                'student_id'=>$student->id,
                'class_id'=>$r->integer('class_id'),
                'package_id'=>$r->integer('package_id'),
                'sales_id'=>$r->user()->id,
                'start_at'=>now(),
                'status'=>'active',
            ]);
            $pkg = Package::find($r->integer('package_id'));
            Invoice::create([
              'student_id'=>$student->id,
              'enrollment_id'=>$enrollment->id,
              'amount'=>$pkg->price,
              'due_date'=>now()->addDays(7),
              'branch_id'=>$r->user()->branch_id ?? 1,
              'status'=>'unpaid'
            ]);
            $lead->update(['status'=>'won']);
        });
        return back()->with('ok','Lead dikonversi ke enrollment + invoice dibuat');
    }
}
