<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $projects = Project::paginate(10);
            return view('backends.projects.list', compact('projects','keyword'));
        } else{
            $projects = Project::where('title','like','%'.$keyword.'%')->Orwhere('procurement','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.projects.list', compact('projects','keyword'));
    }



    public function create()
    {
        $devices = Device::all();
        return view('backends.projects.create',compact('devices'));
    }

    public function store(Request  $request)
    {
        $rules = [
			'title'=>'required',
			'procurement'=>'required',
            'decision'=>'required',
            'note'=>'required',
            'status'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'procurement.required'=>'Please enter procurement',
            'decision.required'=>'Please enter decision',
            'note.required'=>'Please choose note',
            'status.required'=>'Please enter status',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('project.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        Project::create($atribute);
        return redirect()->route('project.index')->with('success','Thêm thành công');
        endif;
    }

    public function edit($id)
    {
        $projects = Project::findOrFail($id);
        $devices = Device::all();
        return view('backends.projects.edit',compact('projects','devices'));
    }

    public function update(Request  $request , $id)
    {
        $rules = [
            'title'=>'required',
			'procurement'=>'required',
            'decision'=>'required',
            'note'=>'required',
            'status'=>'required',
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'procurement.required'=>'Please enter procurement',
            'decision.required'=>'Please enter decision',
            'note.required'=>'Please choose note',
            'status.required'=>'Please enter status',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('project.edit',$id)->withErrors($validator)->withInput();
		else:
        $projects = Project::findOrFail($id);
        $atribute = $request->all();
        $projects->update($atribute);
        if($projects){
            if($projects->wasChanged())
                return redirect()->route('project.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('project.edit',$id);
        }else{
            return redirect()->route('project.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();
        return redirect()->route('project.index')->with('success','Xóa thành công');
    }

}