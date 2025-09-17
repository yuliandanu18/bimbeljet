<?php
use App\Models\{Lead, Package, ClassRoom, Invoice, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('converts lead to enrollment and creates invoice', function(){
  $user = User::factory()->create();
  $this->actingAs($user);

  // Minimal related data
  \DB::table('branches')->insert(['id'=>1,'name'=>'Pusat','address'=>null,'created_at'=>now(),'updated_at'=>now()]);
  $pkgId = \DB::table('packages')->insertGetId(['name'=>'Matematika Reg','subject'=>'Matematika','meetings'=>8,'minutes_per_meeting'=>90,'price'=>500000,'allow_installment'=>0,'branch_id'=>1,'created_at'=>now(),'updated_at'=>now()]);
  $classId = \DB::table('classes')->insertGetId(['code'=>'MATH-1','name'=>'Matematika A','type'=>'regular','subject'=>'Matematika','capacity'=>10,'branch_id'=>1,'room'=>'A1','online_link'=>null,'package_id'=>$pkgId,'tutor_id'=>null,'start_date'=>date('Y-m-d'),'created_at'=>now(),'updated_at'=>now()]);

  $lead = Lead::create(['name'=>'Budi','phone'=>'0812','status'=>'new','owner_id'=>$user->id,'branch_id'=>1]);

  $res = $this->post(route('leads.convert',$lead), ['class_id'=>$classId,'package_id'=>$pkgId]);
  $res->assertSessionHas('ok');

  expect(Invoice::count())->toBe(1);
});
