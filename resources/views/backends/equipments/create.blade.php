@extends('backends.templates.master')
@section('title',__('Thêm Chi Tiết Thiết Bị'))
@section('content')
@php 
$statusEquipments = get_statusEquipments();
@endphp
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{ route('equipment.index') }}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Thêm Chi Tiết Thiết Bị') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('equipment.post') }}" class="dev-form" data-filter="{{ route('equiment.select') }}" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label">{{ __('Tên thiết bị') }} <small>({{ __('require') }})</small></label>
                                <input type="text" name="title" value="{{ Request::old('title') }}" class="form-control" data-error="{{ __('Vui lòng nhập tiêu đề hiển thị')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Nhóm thiết bị') }} <small>({{ __('require') }})</small></label>
                                    <select class="form-control select2" id="eq_cates"  name="cate_id">
                                        @foreach ($cates as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                                        @endforeach
                                    </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group" id="ClassId">
                                <label class="control-label">{{ __('Loại thiết bị') }} <small>({{ __('require') }})</small></label>
                                <select  class="select2 form-control" name="equipment_device[]"  multiple="multiple">
                                    @foreach ($devices as $device)
                                        <option  value="{{$device->id}}">{{$device->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Đơn vị tính') }} <small>({{ __('require') }})</small></label>
                                    <select class="form-control select2"  name="unit_id">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Người nhập') }} <small>({{ __('require') }})</small></label>
                                    <select class="form-control select2"  name="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Trạng thái') }} <small>({{ __('require') }})</small></label>
                                <select class="form-control select2"  name="status">
                                    @foreach ($statusEquipments as $key => $items)
                                        <option value="{{ $key }}">{{ $items }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Mã thiết bị') }} <small>({{ __('require') }})</small></label>
                                <input name="code" type="text" class="form-control" value="{{ Request::old('code') }}" data-error="{{ __('Vui lòng nhập mã  hiển thị')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Số serial') }} <small>({{ __('require') }})</small></label>
                                <input name="serial" type="text" class="form-control" value="{{ Request::old('serial') }}" data-error="{{ __('Vui lòng nhập số serial')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                            <label class="control-label">{{ __('Đơn vị bảo trì') }} <small>({{ __('require') }})</small></label>
                                <select class="form-control select2"  name="maintenance_id">
                                    @foreach ($maintenances as $maintenance)
                                        <option value="{{ $maintenance->id }}">{{ $maintenance->title }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                            <label class="control-label">{{ __('Nhà cung cấp') }} <small>({{ __('require') }})</small></label>
                                <select class="form-control select2"  name="provider_id">
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->title }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                            <label class="control-label">{{ __('Đơn vị sửa chũa') }} <small>({{ __('require') }})</small></label>
                                <select class="form-control select2"  name="repair_id">
                                    @foreach ($repairs as $repair)
                                        <option value="{{ $repair->id }}">{{ $repair->title }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                            <label class="control-label">{{ __('Khoa - Phòng Ban') }} <small>({{ __('require') }})</small></label>
                                <select class="form-control select2"  name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->title }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Thêm') }}</button>
                                <a href="{{ route('equipment.index') }}" class="btn btn-secondary">{{ __('Trở về') }}</a>	
                            </div>
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
                                                {!! image('',230,230,__('Avatar')) !!}
                                                <input type="hidden" name="image" class="thumb-media" value="" />
                                            </div>
                                        </div>
                                    </div>
                            </aside>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@include('backends.media.library')
@endsection