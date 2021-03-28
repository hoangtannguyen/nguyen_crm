@extends('backends.templates.master')
@section('title',__('Hồ Sơ Thiết Bị'))
@section('content')
@php 
$statusEquipments = get_statusEquipments();
$get_statusAction = get_statusAction();
@endphp
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{ route('equipment.index') }}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Hồ Sơ Thiết Bị') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="" class="dev-form" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                                <caption># Thiết bị</caption>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ __('Tên thiết bị') }} </th>
                                                <td>{{ $equipments->title}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Nhóm thiết bị') }} </th>
                                                <td>{{ $equipments->equipment_cates->title }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Loại thiết bị') }} </th>
                                                    <td>
                                                        @foreach ($equipments->equipment_device as $number => $equipment_device)
                                                            {{ $number > 0 ? ', ' : '' }}{{$equipment_device->title}}
                                                        @endforeach
                                                    </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Đơn vị tính') }} </th>
                                                <td>{{ $equipments->equipment_unit->title }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Người nhập') }} </th>
                                                <td>{{ $equipments->equipment_user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Trạng thái') }} </th>
                                                @if($equipments->status === "active")
                                                    <td style="color:green" >{{ $statusEquipments[$equipments->status] }}</td>
                                                @else 
                                                    <td style="color:black" >{{ $statusEquipments[$equipments->status] }}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Nhóm thiết bị') }} </th>
                                                <td>{{ $equipments->equipment_cates->title }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Mã hiển thị') }} </th>
                                                <td>{{  $equipments->code }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Số serial') }}  </th>
                                                <td>{{  $equipments->serial }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Đơn vị bảo trì') }}  </th>
                                                <td>{{ $equipments->equipment_maintenance->title }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Nhà cung cấp') }}  </th>
                                                <td>{{ $equipments->equipment_provider->title }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Đơn vị sửa chữa') }}  </th>
                                                <td>{{  $equipments->equipment_repair->title }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Khoa - Phòng Ban') }} </th>
                                                <td>{{ $equipments->equipment_department->title }}</td>
                                            </tr>
                                        </tbody>
                                </table>
                        </div>
                        <div class="col-md-3">
                            <aside id="sb-image" class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ __('Ảnh đại diện') }}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="frm-avatar" class="img-upload">
                                            <div class="image">
                                                <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                {!! image($equipments->image,230,230,__('Avatar')) !!}
                                                <input type="hidden" name="image" class="thumb-media" value="{{ $equipments->image }}"/>
                                            </div>
                                        </div>
                                    </div>
                            </aside>
                        </div>
                    </div>
                </form>
            </div>
            <caption># Sửa chữa thiết bị</caption>
                            @php $repairs = isset($equipments->action_repair) ? $equipments->action_repair : false;  @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Ảnh') }}</th>
                                        <th>{{ __('Tên thiết bị') }}</th>
                                        <th>{{ __('Mã hiển thị') }}</th>
                                        <th>{{ __('Người nhập') }}</th>
                                        <th>{{ __('Lý do') }}</th>
                                        <th>{{ __('Nội dung') }}</th>
                                        <th>{{ __('Trạng thái') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($repairs)
                                        @foreach($repairs as $item)
                                        <tr> 
                                            <td style="width:80px;height:80px">
                                                 {!! image($item->image, 100,100) !!}
                                            </td>   
                                            <td>
                                                {{ $item->action_equipment->title }}
                                            </td>
                                            <td>
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ $item->action_user->name }}
                                            </td>
                                            <td>
                                                {!! $item->reason !!}

                                            </td>
                                            <td>
                                                {!! $item->content !!}
                                            </td>
                                            @if($item->status === "active")
                                                <td style = "color:green">
                                                    {{ $get_statusAction[$item->status] }}
                                                </td>
                                            @else 
                                                <td style = "color:black">
                                                    {{ $get_statusAction[$item->status] }}
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                     @endif
                                </tbody>
                            </table>


                            <caption># Bảo dưỡng định kỳ</caption>
                            @php $periodic = isset($equipments->action_periodic) ? $equipments->action_periodic : false;  @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Ảnh') }}</th>
                                        <th>{{ __('Tên thiết bị') }}</th>
                                        <th>{{ __('Mã hiển thị') }}</th>
                                        <th>{{ __('Người nhập') }}</th>
                                        <th>{{ __('Lý do') }}</th>
                                        <th>{{ __('Nội dung') }}</th>
                                        <th>{{ __('Trạng thái') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($periodic)
                                        @foreach($periodic as $item)
                                        <tr>
                                            <td style="width:80px;height:80px">
                                                 {!! image($item->image, 100,100) !!}
                                            </td>       
                                            <td>
                                                {{ $item->action_equipment->title }}
                                            </td>
                                            <td>
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ $item->action_user->name }}
                                            </td>
                                            <td>
                                                {!! $item->reason !!}

                                            </td>
                                            <td>
                                                {!! $item->content !!}
                                            </td>
                                            @if($item->status === "active")
                                            <td style = "color:green">
                                                {{ $get_statusAction[$item->status] }}
                                            </td>
                                            @else 
                                                <td style = "color:black">
                                                    {{ $get_statusAction[$item->status] }}
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                     @endif
                                </tbody>
                            </table>


                            <caption># Kiểm định thiết bị</caption>
                            @php $accredita = isset($equipments->action_accredita) ? $equipments->action_accredita : false;  @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Ảnh') }}</th>
                                        <th>{{ __('Tên thiết bị') }}</th>
                                        <th>{{ __('Mã hiển thị') }}</th>
                                        <th>{{ __('Người nhập') }}</th>
                                        <th>{{ __('Lý do') }}</th>
                                        <th>{{ __('Nội dung') }}</th>
                                        <th>{{ __('Trạng thái') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($accredita)
                                        @foreach($accredita as $item)
                                        <tr>    
                                            <td style="width:80px;height:80px">
                                                 {!! image($item->image, 100,100) !!}
                                            </td>   
                                            <td>
                                                {{ $item->action_equipment->title }}
                                            </td>
                                            <td>
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ $item->action_user->name }}
                                            </td>
                                            <td>
                                                {!! $item->reason !!}

                                            </td>
                                            <td>
                                                {!! $item->content !!}
                                            </td>
                                            @if($item->status === "active")
                                                <td style = "color:green">
                                                    {{ $get_statusAction[$item->status] }}
                                                </td>
                                            @else 
                                                <td style = "color:black">
                                                    {{ $get_statusAction[$item->status] }}
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                     @endif
                                </tbody>
                            </table>
        </div>
    </section>
</div>


@include('backends.media.library')
@endsection