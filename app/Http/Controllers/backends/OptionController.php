<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Media;

class OptionController extends Controller {
    public function index(){
        $array = array('logo', 'favicon', 'site_name', 'address', 'email', 'hotline');
        $res = array();
        foreach ($array as $item) {
            $option = Option::firstOrCreate(['key'=>$item]);
            $res[$item] = $option->value;
        }
        $data = [
            'option' => $res,
        ];
        return view('backends.options.system',$data);
    }
    public function update(Request $request){
        $array = array('logo', 'favicon', 'site_name', 'address', 'email', 'hotline');
        foreach ($array as $item) {
            if($request->$item) Option::where('key', $item)->update(['value'=>$request->$item]);
        }
        $request->session()->flash('success', 'Update Successful!');
        return redirect()->route('admin.system');
    }
}