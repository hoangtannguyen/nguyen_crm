<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Action;
use App\Models\Equipment;
use Illuminate\Support\Facades\Validator;


class ActionController extends Controller {

    public function index(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $eqrepairs = Action::eqrepair()->paginate(10);
            return view('backends.eqrepairs.list', compact('eqrepairs','keyword'));
        } else{
            $eqrepairs = Action::where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.eqrepairs.list', compact('eqrepairs','keyword'));
    }


    public function create()
    {
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        return view('backends.eqrepairs.create',compact('users','equipments'));
    }

    public function store(Request  $request)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'equi_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('eqrepair.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'equipment_repair';
        Action::create($atribute);
        return redirect()->route('eqrepair.index')->with('success','Thêm thành công');
        endif;
    }

    public function edit($id)
    {
        $eqrepairs = Action::findOrFail($id);
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        $array = $eqrepairs->action_equipment->pluck('id')->toArray();
        return view('backends.eqrepairs.edit',compact('eqrepairs','equipments','array','users'));
    }

    public function update(Request  $request , $id)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('eqrepair.edit',$id)->withErrors($validator)->withInput();
		else:
        $eqrepairs = Action::findOrFail($id);
        $atribute = $request->all();
        $eqrepairs->update($atribute);
        if($eqrepairs){
            if($eqrepairs->wasChanged())
                return redirect()->route('eqrepair.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('eqrepair.edit',$id);
        }else{
            return redirect()->route('eqrepair.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroy($id)
    {
        $eqrepairs = Action::findOrFail($id);
        $eqrepairs->delete();
        return redirect()->route('eqrepair.index')->with('success','Xóa thành công');
    }



    public function indexPeriodic(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $periodics = Action::periodic()->paginate(10);
            return view('backends.periodics.list', compact('periodics','keyword'));
        } else{
            $periodics = Action::where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.periodics.list', compact('periodics','keyword'));
    }



    public function createPeriodic()
    {
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        return view('backends.periodics.create',compact('users','equipments'));
    }

    public function storePeriodic(Request  $request)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('periodic.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'periodic_maintenance';
        Action::create($atribute);
        return redirect()->route('periodic.index')->with('success','Thêm thành công');
        endif;
    }

    public function editPeriodic($id)
    {
        $periodics = Action::findOrFail($id);
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        $array = $periodics->action_equipment->pluck('id')->toArray();
        return view('backends.periodics.edit',compact('periodics','equipments','array','users'));
    }

    public function updatePeriodic(Request  $request , $id)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('periodic.edit',$id)->withErrors($validator)->withInput();
		else:
        $periodics = Action::findOrFail($id);
        $atribute = $request->all();
        $periodics->update($atribute);
        if($periodics){
            if($periodics->wasChanged())
                return redirect()->route('periodic.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('periodic.edit',$id);
        }else{
            return redirect()->route('periodic.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroyPeriodic($id)
    {
        $periodics = Action::findOrFail($id);
        $periodics->delete();
        return redirect()->route('periodic.index')->with('success','Xóa thành công');
    }


    public function indexAccre(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $eqaccres = Action::accre()->paginate(10);
            return view('backends.eqaccres.list', compact('eqaccres','keyword'));
        } else{
            $eqaccres = Action::where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.eqaccres.list', compact('eqaccres','keyword'));
    }


    public function createAccre()
    {
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        return view('backends.eqaccres.create',compact('users','equipments'));
    }

    public function storeAccre(Request  $request)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('eqaccre.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'accreditation';
        Action::create($atribute);
        return redirect()->route('eqaccre.index')->with('success','Thêm thành công');
        endif;
    }

    public function editAccre($id)
    {
        $eqaccres = Action::findOrFail($id);
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        $array = $eqaccres->action_equipment->pluck('id')->toArray();
        return view('backends.eqaccres.edit',compact('eqaccres','equipments','array','users'));
    }

    public function updateAccre(Request  $request , $id)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('eqaccre.edit',$id)->withErrors($validator)->withInput();
		else:
        $eqaccres = Action::findOrFail($id);
        $atribute = $request->all();
        $eqaccres->update($atribute);
        if($eqaccres){
            if($eqaccres->wasChanged())
            return redirect()->route('eqaccre.edit',$id)->with('success','Cập nhật thành công');
        else 
            return redirect()->route('eqaccre.edit',$id);
        }else{
            return redirect()->route('eqaccre.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroyAccre($id)
    {
        $eqaccres = Action::findOrFail($id);
        $eqaccres->delete();
        return redirect()->route('eqaccre.index')->with('success','Xóa thành công');
    }



    public function indexTransfer(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $transfers = Action::transfer()->paginate(10);
            return view('backends.transfers.list', compact('transfers','keyword'));
        } else{
            $transfers = Action::where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.transfers.list', compact('transfers','keyword'));
    }


    public function createTransfer()
    {
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        return view('backends.transfers.create',compact('users','equipments'));
    }

    public function storeTransfer(Request  $request)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('transfer.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'transfers';
        $transfers = Action::create($atribute);
        return redirect()->route('transfer.index')->with('success','Thêm thành công');
        endif;
    }

    public function editTransfer($id)
    {
        $transfers = Action::findOrFail($id);
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        $array = $transfers->action_equipment->pluck('id')->toArray();
        return view('backends.transfers.edit',compact('transfers','equipments','array','users'));
    }

    public function updateTransfer(Request  $request , $id)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('transfer.edit',$id)->withErrors($validator)->withInput();
		else:
        $transfers = Action::findOrFail($id);
        $atribute = $request->all();
        $transfers->update($atribute);
        if($transfers){
            if($transfers->wasChanged())
                return redirect()->route('transfer.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('transfer.edit',$id);
        }else{
            return redirect()->route('transfer.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroyTransfer($id)
    {
        $transfers = Action::findOrFail($id);
        $transfers->delete();
        return redirect()->route('eqaccre.index')->with('success','Xóa thành công');
    }


    public function indexLiquida(Request  $request)
    {
        $keyword = $request->key;
        if(!$keyword){
            $liquidations = Action::liquida()->paginate(10);
            return view('backends.liquidations.list', compact('liquidations','keyword'));
        } else{
            $liquidations = Action::where('title','like','%'.$keyword.'%')->Orwhere('code','like','%'.$keyword.'%')->paginate(10);
        }
        return view('backends.liquidations.list', compact('liquidations','keyword'));
    }


    public function createLiquida()
    {
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        return view('backends.liquidations.create',compact('users','equipments'));
    }

    public function storeLiquida(Request  $request)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('liquidation.create')->withErrors($validator)->withInput();
		else:
        $atribute = $request->all();
        $atribute['type'] = 'liquidations';
        Action::create($atribute);
        return redirect()->route('liquidation.index')->with('success','Thêm thành công');
        endif;
    }

    public function editLiquida($id)
    {
        $liquidations = Action::findOrFail($id);
        $users = User::select('id','name')->get();
        $equipments = Equipment::select('id','title')->device()->get();
        $array = $liquidations->action_equipment->pluck('id')->toArray();
        return view('backends.liquidations.edit',compact('liquidations','equipments','array','users'));
    }

    public function updateLiquida(Request  $request , $id)
    {
        $rules = [
			'code'=>'required',
            'user_id'=>'required',
            'reason'=>'required',
            'content'=>'required',
            'status'=>'required',
            'equi_id'=>'required',
        ];
        $messages = [
			'code.required'=>'Please enter code',
            'user_id.required'=>'Please enter user',
            'reason.required'=>'Please enter reason',
            'content.required'=>'Please choose content',
            'status.required'=>'Please enter status',
            'equi_id.required'=>'Please enter equipment',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('liquidation.edit',$id)->withErrors($validator)->withInput();
		else:
        $liquidations = Action::findOrFail($id);
        $atribute = $request->all();
        $liquidations->update($atribute);
        if($liquidations){
            if($liquidations->wasChanged())
                return redirect()->route('liquidation.edit',$id)->with('success','Cập nhật thành công');
            else 
                return redirect()->route('liquidation.edit',$id);
        }else{
            return redirect()->route('liquidation.edit',$id)->with('error','Cập nhật không thành công');
        }
    endif;
    }

    public function destroyLiquida($id)
    {
        $liquidations = Action::findOrFail($id);
        $liquidations->delete();
        return redirect()->route('liquidation.index')->with('success','Xóa thành công');
    }





}