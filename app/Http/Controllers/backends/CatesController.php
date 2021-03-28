<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cates;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CatesController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $equipment_cates = Cates::paginate(10);
            return view('backends.cates.list', compact('equipment_cates','keyword'));
        } else{
            $equipment_cates = Cates::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.cates.list', compact('equipment_cates','keyword'));
    }

    public function create()
    {
        return view('backends.cates.create');
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
            return redirect()->route('equipment_cate.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        Cates::create($atribute);
        return redirect()->route('equipment_cate.index')->with('success','Thêm thành công');
        endif;
    }

    public function edit($id)
    {
        $equipment_cates = Cates::findOrFail($id);
        return view('backends.cates.edit',compact('equipment_cates'));
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
            return redirect()->route('equipment_cate.edit',$id)->withErrors($validator)->withInput();
		else:
        $equipment_cates = Cates::findOrFail($id);
        $atribute = $request->all();
        $equipment_cates->update($atribute);
        if($equipment_cates){
            if($equipment_cates->wasChanged())
                return redirect()->route('equipment_cate.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('equipment_cate.edit',$id);
        }else{
            return redirect()->route('equipment_cate.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $equipment_cates = Cates::findOrFail($id);
        $equipment_cates->delete();
        return redirect()->route('equipment_cate.index')->with('success','Xóa thành công');
    }


}