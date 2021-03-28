@extends('backends.templates.master')
@section('title', __('Chi tiết vật tư'))
@section('content')
@php 
$statusEquipments = get_statusEquipments();
@endphp
<div id="list-events" class="content-wrapper events">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Chi tiết vật tư') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                  <li class="active"><a href="{{ route('eqsupplie.index') }}">{{ __('Tất cả') }}</a></li>
                  <li class=""><a class="btn btn-success" style="color: #fff;" href="{{ route('eqsupplie.create') }}">{{ _('Thêm mới') }}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form action="{{ route('eqsupplie.index') }}" method="GET">
                  <div class="row">
                     <div class="col-md-12 s-key">
                        <input type="text" name="key" class="form-control s-key" placeholder="{{__('Nhập từ khóa')}}" value="{{$keyword}}">
                     </div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
               </form>
            </div>
         </div>
         <div class="card">
            <div class="card-body p-0">
               @include('notices.index')
               <form class="dev-form" action="" name="listEvent" method="POST">
                  @csrf
                  <table class="table table-striped projects" role="table">
                     <thead class="thead">
                        <tr>
                           <!-- <th>{{ __('Id') }}</th> -->
                           <th>{{ __('Ảnh đại diện') }}</th>
                           <th>{{ __('Tên vật tư') }}</th>
                           <th>{{ __('Loại vật tư') }}</th>
                           <th>{{ __('Đơn vị tính') }}</th>
                           <th>{{ __('Người nhập') }}</th>
                           <th>{{ __('Trạng thái') }}</th>
                           <th>{{ __('Nhóm thiết bị') }}</th>
                           <th>{{ __('Mã hiển thị') }}</th>
                           <!-- <th>{{ __('Số serial') }}</th> -->
                           <th>{{ __('Đơn vị bảo trì') }}</th>
                           <!-- <th>{{ __('Nhà cung cấp') }}</th>
                           <th>{{ __('Đơn vị sửa chữa') }}</th> -->
                           <!-- <th>{{ __('Khoa phòng ban') }}</th> -->
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if(!$supplies->isEmpty())
                        @foreach($supplies as $key => $supplie)
                     <tr>
                        <!-- <td>{{  ++$key}}</td> -->
                        <td class="image"><a href="{{ route('eqsupplie.edit' , $supplie->id )}}">{!! image($supplie->image, 100,100) !!}</a></td>
                        <td>{{ $supplie->title}}</td>
                        <td>
                            @foreach ($supplie->equipment_supplie as $number_key => $equipment_supplie)
                              {{ $number_key > 0 ? ', ' : '' }}{{$equipment_supplie->title}}
                             @endforeach
                        </td>
                        <td>
                             {{ $supplie->equipment_unit->title }}
                        </td>
                        <td>{{ $supplie->equipment_user->name }}</td>
                        <td>{{ $statusEquipments[$supplie->status] }}</td>
                        <td>{{ $supplie->equipment_cates->title }}</td>
                        <td>{{ $supplie->code}}</td>
                        <!-- <td>{{ $supplie->serial}}</td> -->
                        <td>{{ $supplie->equipment_maintenance->title }}</td>
                        <!-- <td>{{ $supplie->equipment_provider->title }}</td>
                        <td>{{ $supplie->equipment_repair->title }}</td> -->
                        <!-- <td>{{ $supplie->equipment_department->title }}</td> -->
                        <td class="group-action text-right">
                          <a class="btn btn-info btn-sm" href="{{ route('eqsupplie.edit' , $supplie->id )}}"><i class="fas fa-pencil-alt"></i>{{__('Sửa')}}</a>
                        </td>                       
                        <td>  
                           <a class="btn btn-danger btn-sm" href="{{ route('eqsupplie.delete',$supplie->id ) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{__('Xóa')}}</a>
                        </td>
                     </tr>
                        @endforeach
                        @else
                        <tr>
                           <td colspan="15">{{ __('No items!') }}</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </form>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- Side Modal Top Right -->
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection