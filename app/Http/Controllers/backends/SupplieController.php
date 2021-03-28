<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SupplieController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $supplies = Supplie::paginate(10);
            return view('backends.supplies.list', compact('supplies','keyword'));
        } else{
            $supplies = Supplie::where('title','like','%'.$keyword.'%')->Orwhere('slug','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.supplies.list', compact('supplies','keyword'));
    }

    public function create()
    {
        return view('backends.supplies.create');
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
            return redirect()->route('supplie.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        Supplie::create($atribute);
        return redirect()->route('supplie.index')->with('success','Thêm thành công');
        endif;
    }

    public function edit($id)
    {
        $supplies = Supplie::findOrFail($id);
        return view('backends.supplies.edit',compact('supplies'));
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
            return redirect()->route('supplie.edit',$id)->withErrors($validator)->withInput();
		else:
        $supplies = Supplie::findOrFail($id);
        $atribute = $request->all();
        $supplies->update($atribute);
        if($supplies){
            if($supplies->wasChanged())
                return redirect()->route('supplie.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('supplie.edit',$id);
        }else{
            return redirect()->route('supplie.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $supplies = Supplie::findOrFail($id);
        $supplies->delete();
        return redirect()->route('supplie.index')->with('success','Xóa thành công');
    }


}