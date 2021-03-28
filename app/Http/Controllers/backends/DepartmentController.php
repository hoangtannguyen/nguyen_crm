<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $departments = Department::paginate(10);
            return view('backends.departments.list', compact('departments','keyword'));
        } else{
            $departments = Department::where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.departments.list', compact('departments','keyword'));
    }



    public function create()
    {
        $users = User::select('id','name')->get();
        $nursings = User::select('id','name')->get();
        return view('backends.departments.create',compact('users','nursings'));
    }

    public function store(Request  $request)
    {
        $rules = [
			'title'=>'required',
			'code'=>'required',
            'phone'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required',
            'user_id'=>'required',
            'nursing_id'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'code.required'=>'Please enter code',
            'phone.required'=>'Please enter phone',
            'contact.required'=>'Please enter contact',
            'email.required'=>'Please choose email',
            'address.required'=>'Please enter address',
            'user_id.required'=>'Please enter user',
            'nursing_id.required'=>'Please enter nursing',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('department.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        Department::create($atribute);
        return redirect()->route('department.index')->with('success','Thêm thành công');
        endif;
    }

    public function edit($id)
    {
        $departments = Department::findOrFail($id);
        $users = User::select('id','name')->get();
        $nursings = User::select('id','name')->get();
        return view('backends.departments.edit',compact('departments','users','nursings'));
    }

    public function update(Request  $request , $id)
    {
        $rules = [
			'title'=>'required',
			'code'=>'required',
            'phone'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required',
            'user_id'=>'required',
            'nursing_id'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'code.required'=>'Please enter code',
            'phone.required'=>'Please enter phone',
            'contact.required'=>'Please enter contact',
            'email.required'=>'Please choose email',
            'address.required'=>'Please enter address',
            'user_id.required'=>'Please enter user',
            'nursing_id.required'=>'Please enter nursing',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('department.edit',$id)->withErrors($validator)->withInput();
		else:
        $departments = Department::findOrFail($id);
        $atribute = $request->all();
        $departments->update($atribute);
        if($departments){
            if($departments->wasChanged())
                return redirect()->route('department.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('department.edit',$id);
        }else{
            return redirect()->route('department.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $departments = Department::findOrFail($id);
        $departments->delete();
        return redirect()->route('department.index')->with('success','Xóa thành công');
    }

}