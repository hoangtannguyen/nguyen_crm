<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Provider;
use App\Models\User;
use App\Models\Cates;
use App\Models\Unit;
use App\Models\Department;
use App\Models\Device;
use App\Models\Supplie;
use App\Models\Action;
use Illuminate\Support\Facades\Validator;


class EquipmentController extends Controller {

    public function index(Request  $request) {
        $keyword = isset($request->key) ? $request->key : '';
        $status = isset($request->status) ? $request->status : '';
        $equipments = Equipment::query();
        if($keyword != ''){
            $equipments = $equipments->where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%');
        }
        if($status != '') $equipments = $equipments->where('status',$status);
        $equipments = $equipments->device()->paginate(10);
        return view('backends.equipments.list', compact('equipments','keyword'));
    }

    public function show($id) 
    {
        $equipments = Equipment::findOrFail($id);
        return view('backends.profiles.show', compact('equipments'));
    }

    public function select(Request $request ){
        $devices = Device::select('id','title','cat_id')->get();
        $html = '<label class="control-label">'.__('Loại thiết bị').' <small>('.__('require').')</small></label>';
        $html .= '<select  class="select2 form-control" name="equipment_device[]"  multiple="multiple">';
        if($devices) {
            foreach($devices as $item) {
        $html .= '<option value="'.$item->id.'"'.(($item->cat_id == $request->id ? ' selected' : '')).'>'.$item->title.'</option>';
            }
        }
        $html .= '</select><div class="help-block with-errors"></div>';
        return response()->json([
            'check' => 'true',
            'html' => $html
        ]);
    }

    public function create()
    {
        $maintenances = Provider::select('id','title','type')->maintenance()->get();
        $providers = Provider::select('id','title','type')->provider()->get();
        $repairs = Provider::select('id','title','type')->repair()->get();
        $users = User::select('id','name')->get();
        $cates = Cates::select('id','title')->get();
        $units = Unit::select('id','title')->get();
        $departments = Department::select('id','title')->get();
        $devices = Device::select('id','title')->get();
        $supplies = Supplie::select('id','title')->get();
        return view('backends.equipments.create',compact('maintenances','providers','repairs','users','cates','units','departments','devices','supplies'));
    }

    public function store(Request  $request)
    {
        $rules = [
            'title'=>'required',
            'code'=>'required',
            'serial'=>'required',
            'status'=>'required',
            'maintenance_id'=>'required',
            'provider_id'=>'required',
            'repair_id'=>'required',
            'user_id'=>'required',
            'cate_id'=>'required',
            'unit_id'=>'required',  
            'department_id'=>'required',
        ];
        $messages = [
            'code.required'=>'Please choose code',
            'serial.required'=>'Please choose serial',
            'status.required'=>'Please choose status',
            'maintenance_id.required'=>'Please choose maintenance',
            'provider_id.required'=>'Please choose provider',
            'repair_id.required'=>'Please choose repair',
            'user_id.required'=>'Please choose user',
            'cate_id.required'=>'Please choose cate',
            'unit_id.required'=>'Please choose unit',
            'department_id.required'=>'Please choose department',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('equipment.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'devices';
        $equipments = Equipment::create($atribute);
        $equipments->equipment_device()->attach($request->equipment_device);
        if($equipments){
            return redirect()->route('equipment.index')->with('success','Thêm thành công');
        }else{
            return redirect()->route('equipment.index')->with('success','Thêm không thành công');
        }
        endif;
    }

    public function edit($id)
    {
        $equipments = Equipment::findOrFail($id);
        $maintenances = Provider::select('id','title','type')->maintenance()->get();
        $providers = Provider::select('id','title','type')->provider()->get();
        $repairs = Provider::select('id','title','type')->repair()->get();
        $users = User::select('id','name')->get();
        $cates = Cates::select('id','title')->get();
        $units = Unit::select('id','title')->get();
        $departments = Department::select('id','title')->get();
        $devices = Device::select('id','title')->get();
        $array = $equipments->equipment_device->pluck('id')->toArray();
        return view('backends.equipments.edit',compact('equipments','maintenances','providers','repairs','users','cates','units','departments','devices','array'));
    }

    public function update(Request  $request , $id)
    {
        $rules = [
			'title'=>'required',
            'code'=>'required',
            'serial'=>'required',
            'status'=>'required',
            'maintenance_id'=>'required',
            'provider_id'=>'required',
            'repair_id'=>'required',
            'user_id'=>'required',
            'cate_id'=>'required',
            'unit_id'=>'required',  
            'department_id'=>'required',
        ];
        $messages = [
			'title.required'=>'Please choose enter title',
            'code.required'=>'Please choose code',
            'serial.required'=>'Please choose serial',
            'status.required'=>'Please choose status',
            'maintenance_id.required'=>'Please choose maintenance',
            'provider_id.required'=>'Please choose provider',
            'repair_id.required'=>'Please choose repair',
            'user_id.required'=>'Please choose user',
            'cate_id.required'=>'Please choose cate',
            'unit_id.required'=>'Please choose unit',
            'department_id.required'=>'Please choose department',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('equipment.edit',$id)->withErrors($validator)->withInput();
		else:
        $equipments = Equipment::findOrFail($id);
        $atribute = $request->all();
        $equipments->update($atribute);
        $equipments->equipment_device()->sync($request->equipment_device);
        if($equipments){
            return redirect()->route('equipment.edit',$id)->with('success','Cập nhật thành công');
        }else{
            return redirect()->route('equipment.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $equipments = Equipment::findOrFail($id);
        $equipments->delete();
        return redirect()->route('equipment.index')->with('success','Xóa thành công');
    }

    public function status(Request $request ,$key)
    {
        $equipments = Equipment::select('status')->where('status', $key )->get();
        $keyword = $request->key;
        return view('backends.equipments.list', compact('equipments','keyword'));
    }



    public function indexSupplie(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $supplies = Equipment::supplie()->paginate(10);
            return view('backends.eqsupplies.list', compact('supplies','keyword'));
        } else{
            $supplies = Equipment::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.eqsupplies.list', compact('supplies','keyword'));
    }

    public function createSupplie()
    {
        $maintenances = Provider::select('id','title','type')->maintenance()->get();
        $providers = Provider::select('id','title','type')->provider()->get();
        $repairs = Provider::select('id','title','type')->repair()->get();
        $users = User::select('id','name')->get();
        $cates = Cates::select('id','title')->get();
        $units = Unit::select('id','title')->get();
        $departments = Department::select('id','title')->get();
        $devices = Device::select('id','title')->get();
        $supplies = Supplie::select('id','title')->get();
        return view('backends.eqsupplies.create',compact('maintenances','providers','repairs','users','cates','units','departments','devices','supplies'));
    }

    public function storeSupplie(Request  $request)
    {
        $rules = [
            'title'=>'required',
            'code'=>'required',
            'serial'=>'required',
            'status'=>'required',
            'maintenance_id'=>'required',
            'provider_id'=>'required',
            'repair_id'=>'required',
            'user_id'=>'required',
            'cate_id'=>'required',
            'unit_id'=>'required',  
            'department_id'=>'required',
        ];
        $messages = [
            'code.required'=>'Please choose code',
            'serial.required'=>'Please choose serial',
            'status.required'=>'Please choose status',
            'maintenance_id.required'=>'Please choose maintenance',
            'provider_id.required'=>'Please choose provider',
            'repair_id.required'=>'Please choose repair',
            'user_id.required'=>'Please choose user',
            'cate_id.required'=>'Please choose cate',
            'unit_id.required'=>'Please choose unit',
            'department_id.required'=>'Please choose department',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('eqsupplie.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'supplies';
        $supplies = Equipment::create($atribute);
        $supplies->equipment_supplie()->attach($request->equipment_supplie);
        if($supplies){
            return redirect()->route('eqsupplie.index')->with('success','Thêm thành công');
        }else{
            return redirect()->route('eqsupplie.index')->with('success','Thêm không thành công');
        }
        endif;
    }

    public function editSupplie($id)
    {
        $equipments = Equipment::findOrFail($id);
        $maintenances = Provider::select('id','title','type')->maintenance()->get();
        $providers = Provider::select('id','title','type')->provider()->get();
        $repairs = Provider::select('id','title','type')->repair()->get();
        $users = User::select('id','name')->get();
        $cates = Cates::select('id','title')->get();
        $units = Unit::select('id','title')->get();
        $departments = Department::select('id','title')->get();
        $supplies = Supplie::select('id','title')->get();
        $array = $equipments->equipment_supplie->pluck('id')->toArray();
        return view('backends.eqsupplies.edit',compact('equipments','maintenances','providers','repairs','users','cates','units','departments','supplies','array'));
    }

    public function updateSupplie(Request  $request , $id)
    {
        $rules = [
			'title'=>'required',
            'code'=>'required',
            'serial'=>'required',
            'status'=>'required',
            'maintenance_id'=>'required',
            'provider_id'=>'required',
            'repair_id'=>'required',
            'user_id'=>'required',
            'cate_id'=>'required',
            'unit_id'=>'required',  
            'department_id'=>'required',
        ];
        $messages = [
			'title.required'=>'Please choose enter title',
            'code.required'=>'Please choose code',
            'serial.required'=>'Please choose serial',
            'status.required'=>'Please choose status',
            'maintenance_id.required'=>'Please choose maintenance',
            'provider_id.required'=>'Please choose provider',
            'repair_id.required'=>'Please choose repair',
            'user_id.required'=>'Please choose user',
            'cate_id.required'=>'Please choose cate',
            'unit_id.required'=>'Please choose unit',
            'department_id.required'=>'Please choose department',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('eqsupplie.edit',$id)->withErrors($validator)->withInput();
		else:
        $supplies = Equipment::findOrFail($id);
        $atribute = $request->all();
        $atribute['type'] = 'supplies';
        $supplies->update($atribute);
        $supplies->equipment_supplie()->sync($request->equipment_supplie);
        if($supplies){
            return redirect()->route('eqsupplie.edit',$id)->with('success','Cập nhật thành công');
        }else{
            return redirect()->route('eqsupplie.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroySupplie($id)
    {
        $supplies = Equipment::findOrFail($id);
        $supplies->delete();
        return redirect()->route('eqsupplie.index')->with('success','Xóa thành công');
    }


  
}