<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Cates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DeviceController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $type_devices = Device::paginate(10);
            return view('backends.devices.list', compact('type_devices','keyword'));
        } else{
            $type_devices = Device::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.devices.list', compact('type_devices','keyword'));
    }

    public function create()
    {
        $equipment_cates = Cates::all();
        return view('backends.devices.create',compact('equipment_cates'));
    }

    public function store(Request  $request)
    {
        $rules = [
            'title'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('device.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        Device::create($atribute);
        return redirect()->route('type_device.index')->with('success','Thêm thành công');
        endif;
    }

    public function edit($id)
    {
        $type_devices = Device::findOrFail($id);
        $equipment_cates = Cates::all();
        return view('backends.devices.edit',compact('type_devices','equipment_cates'));
    }

    public function update(Request  $request , $id)
    {
        $rules = [
			'title'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('type_device.edit',$id)->withErrors($validator)->withInput();
		else:
        $type_devices = Device::findOrFail($id);
        $atribute = $request->all();
        $type_devices->update($atribute);
        if($type_devices){
            if($type_devices->wasChanged())
                return redirect()->route('type_device.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('type_device.edit',$id);
        }else{
            return redirect()->route('type_device.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $type_devices = Device::findOrFail($id);
        $type_devices->delete();
        return redirect()->route('type_device.index')->with('success','Xóa thành công');
    }


}