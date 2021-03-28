@extends('backends.templates.master')
@section('title', __('Chi tiết thiết bị'))
@section('content')
@php 
$statusEquipments = get_statusEquipments();
@endphp
<div id="list-events" class="content-wrapper events">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Chi tiết thiết bị') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                  <li class="active"><a href="{{ route('equipment.index') }}">{{ __('Tất cả') }}</a></li>
                  <li class=""><a class="btn btn-success" style="color: #fff;" href="{{ route('equipment.create') }}">{{ _('Thêm mới') }}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form action="{{ route('equipment.index') }}" method="GET">
                  <div class="row">
                     <div class="col-md-12 s-key">
                        <input type="text" name="key" class="form-control s-key" placeholder="{{__('Nhập từ khóa')}}" value="{{$keyword}}">
                     </div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
               </form>
            </div>
         </div>
         <ul class="list-group list-group-horizontal">
            @foreach($statusEquipments as $key => $items)
               <a href="{{ route('equipment.index',['status'=>$key]) }}"><li class="list-group-item">{{ $items }}</li></a>
            @endforeach
         </ul>
         <div class="pt-2">
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
                           <th>{{ __('Tên thiết bị') }}</th>
                           <th>{{ __('Nhóm thiết bị') }}</th>
                           <th>{{ __('Loại thiết bị') }}</th>
                           <th>{{ __('Đơn vị tính') }}</th>
                           <th>{{ __('Người nhập') }}</th>
                           <th>{{ __('Trạng thái') }}</th>
                           <th>{{ __('Mã thiết bị') }}</th>
                           <!-- <th>{{ __('Số serial') }}</th> -->
                           <!-- <th>{{ __('Đơn vị bảo trì') }}</th> -->
                           <!-- <th>{{ __('Nhà cung cấp') }}</th>
                           <th>{{ __('Đơn vị sửa chữa') }}</th> -->
                           <!-- <th>{{ __('Khoa phòng ban') }}</th> -->
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if(!$equipments->isEmpty())
                        @foreach($equipments as $key => $equipment)
                     <tr>
                        <!-- <td>{{  ++$key}}</td> -->
                        <td class="image"><a href="{{ route('equipment.edit' , $equipment->id )}}">{!! image($equipment->image, 100,100) !!}</a></td>
                        <td>{{ $equipment->title}}</td>
                        <td>{{ $equipment->equipment_cates->title }}</td>
                        <td>
                           @foreach ($equipment->equipment_device as $number => $equipment_device)
                             {{ $number > 0 ? ', ' : '' }}{{$equipment_device->title}}
                           @endforeach
                        </td>
                        <td>{{ $equipment->equipment_unit->title }}</td>
                        <td>{{ $equipment->equipment_user->name }}</td>
                        @if ( $equipment->status === 'active')
                           <td style="color: green">{{ $statusEquipments[$equipment->status] }}</td>
                        @else
                           <td style="color: black">{{ $statusEquipments[$equipment->status] }}</td>
                        @endif
                        <td>{{ $equipment->code}}</td>
                        <!-- <td>{{ $equipment->serial}}</td> -->
                        <!-- <td>{{ $equipment->equipment_maintenance->title }}</td> -->
                        <!-- <td>{{ $equipment->equipment_provider->title }}</td>
                        <td>{{ $equipment->equipment_repair->title }}</td> -->
                        <!-- <td>{{ $equipment->equipment_department->title }}</td>  -->
                        <td class="group-action">
                          <a class="btn btn-warning btn-sm" href="{{ route('equipment.show' , $equipment->id )}}"><i class="fa fa-eye"></i>{{__('Chi tiết')}}</a>
                        </td> 
                        <td class="group-action text-right">
                          <a class="btn btn-info btn-sm" href="{{ route('equipment.edit' , $equipment->id )}}"><i class="fas fa-pencil-alt"></i>{{__('Sửa')}}</a>
                        </td>                       
                        <td>  
                           <a class="btn btn-danger btn-sm" href="{{ route('equipment.delete',$equipment->id ) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{__('Xóa')}}</a>
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
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- Side Modal Top Right -->
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection