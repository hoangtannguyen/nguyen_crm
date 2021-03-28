<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Cates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProviderController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $providers = Provider::provider()->paginate(10);
            return view('backends.providers.list', compact('providers','keyword'));
        } else{
            $providers = Provider::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.providers.list', compact('providers','keyword'));
    }

    public function create()
    {
        $equipments = Cates::all();
        return view('backends.providers.create',compact('equipments'));
    }

    public function store(Request  $request)
    {
        $rules = [
			'title'=>'required',
            'tax_code'=>'required',
            'fields_operation'=>'required',
            'note'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
            'tax_code.required'=>'Please choose tax code',
            'fields_operation.required'=>'Please choose fields operation',
            'note.required'=>'Please choose note',
            'contact.required'=>'Please choose contact',
            'email.required'=>'Please choose email',
            'address.required'=>'Please choose address',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('provider.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'providers';
        $atribute['fields_operation'] = json_encode($request->fields_operation);
        $providers = Provider::create($atribute);
        $providers->equipment_cates()->attach($request->equipment_cates);
        if($providers){
            return redirect()->route('provider.index')->with('success','Thêm thành công');
        }else{
            return redirect()->route('provider.index')->with('success','Thêm không thành công');
        }
        endif;
    }

    public function edit($id)
    {
        $providers = Provider::findOrFail($id);
        $equipments = Cates::select('id','title')->get();
        $array = $providers->equipment_cates->pluck('id')->toArray();
        return view('backends.providers.edit',compact('providers','equipments', 'array'));
    }

    public function update(Request  $request , $id)
    {
        $rules = [
			'title'=>'required',
            'tax_code'=>'required',
            'fields_operation'=>'required',
            'note'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
            'tax_code.required'=>'Please choose tax code',
            'fields_operation.required'=>'Please choose fields operation',
            'note.required'=>'Please choose note',
            'contact.required'=>'Please choose contact',
            'email.required'=>'Please choose email',
            'address.required'=>'Please choose address',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('provider.edit',$id)->withErrors($validator)->withInput();
		else:
        $providers = Provider::findOrFail($id);
        $atribute = $request->all();
        $atribute['fields_operation'] = json_encode($request->fields_operation);
        $providers->update($atribute);
        $providers->equipment_cates()->sync($request->equipment_cates);
        if($providers){
            return redirect()->route('provider.edit',$id)->with('success','Cập nhật thành công');
        }else{
            return redirect()->route('provider.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $providers = Provider::findOrFail($id);
        $providers->delete();
        return redirect()->route('provider.index')->with('success','Xóa thành công');
    }


    public function indexMaintenance(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $maintenances = Provider::maintenance()->paginate(10);
            return view('backends.maintenances.list', compact('maintenances','keyword'));
        } else{
            $maintenances = Provider::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.maintenances.list', compact('maintenances','keyword'));
    }

    public function createMaintenance()
    {
        $equipments = Cates::all();
        return view('backends.maintenances.create',compact('equipments'));
    }

    public function storeMaintenance(Request  $request)
    {
        $rules = [
            'title'=>'required',
            'tax_code'=>'required',
            'fields_operation'=>'required',
            'note'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required',
        ];
        $messages = [
            'title.required'=>'Please enter title',
            'tax_code.required'=>'Please choose tax code',
            'fields_operation.required'=>'Please choose fields operation',
            'note.required'=>'Please choose note',
            'contact.required'=>'Please choose contact',
            'email.required'=>'Please choose email',
            'address.required'=>'Please choose address',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('maintenance.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['fields_operation'] = json_encode($request->fields_operation);
        $atribute['type'] = 'maintenances';
        $maintenance = Provider::create($atribute);
        $maintenance->equipment_cates()->attach($request->equipment_cates);
        return redirect()->route('maintenance.index')->with('success','Thêm thành công');
        endif;
    }

    public function editMaintenance($id)
    {
        $maintenances = Provider::findOrFail($id);
        $equipments = Cates::select('id','title')->get();
        $array = $maintenances->equipment_cates->pluck('id')->toArray();
        return view('backends.maintenances.edit',compact('maintenances','equipments','array'));
    }

    public function updateMaintenance(Request  $request , $id)
    {
        $rules = [
            'title'=>'required',
            'tax_code'=>'required',
            'fields_operation'=>'required',
            'note'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required',
        ];
        $messages = [
            'title.required'=>'Please enter title',
            'tax_code.required'=>'Please choose tax code',
            'fields_operation.required'=>'Please choose fields operation',
            'note.required'=>'Please choose note',
            'contact.required'=>'Please choose contact',
            'email.required'=>'Please choose email',
            'address.required'=>'Please choose address',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('maintenance.edit',$id)->withErrors($validator)->withInput();
		else:
        $maintenances = Provider::findOrFail($id);
        $atribute = $request->all();
        $atribute['fields_operation'] = json_encode($request->fields_operation);
        $maintenances->update($atribute);
        $maintenances->equipment_cates()->sync($request->equipment_cates);
        if($maintenances){
            return redirect()->route('maintenance.edit',$id)->with('success','Cập nhật thành công');
        }else{
            return redirect()->route('maintenance.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroyMaintenance($id)
    {
        $maintenances = Provider::findOrFail($id);
        $maintenances->delete();
        return redirect()->route('maintenance.index')->with('success','Xóa thành công');
    }



    
    public function indexRepair(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $repairs = Provider::repair()->paginate(10);
            return view('backends.repairs.list', compact('repairs','keyword'));
        } else{
            $repairs = Provider::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.repairs.list', compact('repairs','keyword'));
    }

    public function createRepair()
    {
        $equipments = Cates::all();
        return view('backends.repairs.create',compact('equipments'));
    }

    public function storeRepair(Request  $request)
    {
        $rules = [
            'title'=>'required',
            'tax_code'=>'required',
            'fields_operation'=>'required',
            'note'=>'required',
        ];
        $messages = [
            'title.required'=>'Please enter title',
            'tax_code.required'=>'Please choose tax code',
            'fields_operation.required'=>'Please choose fields operation',
            'note.required'=>'Please choose note',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('repair.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['fields_operation'] = json_encode($request->fields_operation);
        $atribute['type'] = 'repairs';
        $repair = Provider::create($atribute);
        $repair->equipment_cates()->attach($request->equipment_cates);
        return redirect()->route('repair.index')->with('success','Thêm thành công');
        endif;
    }

    public function editRepair($id)
    {
        $repairs = Provider::findOrFail($id);
        $equipments = Cates::select('id','title')->get();
        $array = $repairs->equipment_cates->pluck('id')->toArray();
        return view('backends.repairs.edit',compact('repairs','equipments','array'));
    }

    public function updateRepair(Request  $request , $id)
    {
        $rules = [
            'title'=>'required',
            'tax_code'=>'required',
            'fields_operation'=>'required',
            'note'=>'required',
        ];
        $messages = [
            'title.required'=>'Please enter title',
            'tax_code.required'=>'Please choose tax code',
            'fields_operation.required'=>'Please choose fields operation',
            'note.required'=>'Please choose note',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('repair.edit',$id)->withErrors($validator)->withInput();
		else:
        $repairs = Provider::findOrFail($id);
        $atribute = $request->all();
        $atribute['fields_operation'] = json_encode($request->fields_operation);

        $repairs->update($atribute);
        $repairs->equipment_cates()->sync($request->equipment_cates);
        if($repairs){
            return redirect()->route('repair.edit',$id)->with('success','Cập nhật thành công');
        }else{
            return redirect()->route('repair.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroyRepair($id)
    {
        $maintenances = Provider::findOrFail($id);
        $maintenances->delete();
        return redirect()->route('repair.index')->with('success','Xóa thành công');
    }



}