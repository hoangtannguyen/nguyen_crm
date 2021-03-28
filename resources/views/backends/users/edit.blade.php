@extends('backends.templates.master')
@section('title', __('Sửa người dùngg'))
@section('content')
<div class="content-wrapper users">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.users')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Sửa người dùng') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.user_update',['id'=>$user->id]) }}" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('Tên') }}</small></label>
                                <input type="text" value="{{ $user->name }}" class="form-control" disabled readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Tên hiển thị') }} <small>({{ __('required') }})</small></label>
                                <input type="text" name="displayname" value="{{ $user->displayname }}" class="form-control" data-error="{{ __('Please input Display name!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Khoa - Phòng ban') }} <small>({{ __('require') }})</small></label>
                                    <select class="form-control select2"  name="department_id">
                                        @foreach ($departments as $department)
                                            <option  {{ $department->id == $user->department_id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->title }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Số điện thoại') }} <small>({{ __('required') }})</small></label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" data-error="{{ __('Please input phone number!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Email') }} <small>({{ __('required') }})</small></label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" data-error="{{ __('Please input user email!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label">{{ __('Địa chỉ') }}</label>
                                <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                            </div>                        
                            <div class="form-group">
                                <label for="password" class="control-label">{{ __('Mật khẩu') }}</small></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="***" data-minlength="8" data-minlength-error="{{ __('Min length is 8 character') }}">
                                <div class="help-block with-errors"></div>
                            </div>          
                            <div  class="form-group" >
                                <label for="confirmPassword" class="control-label">{{ __('Nhập lại mật khẩu') }}</small></label>
                                <input type="password" name="confirmPassword" class="form-control" placeholder="***"  data-match="#password"  data-minlength="8" data-minlength-error="{{ __('Min length is 8 character') }}" data-match-error="{{ __('Password confirm not match!') }}">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Sửa') }}</button>
                                <a href="{{ route('admin.users') }}" class="btn btn-secondary">{{ __('Trở về') }}</a>   
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            <aside class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Chức vụ') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <select class="form-control select2" name="role" data-error="{{ __('Please choose user role') }}" required>
                                        @if($roles)
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}"{{ $user->hasRole($role->name) ? ' selected' : '' }}>{{ $role->display_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </aside>
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
                                            {!! image($user->image,230,230,__('Avatar')) !!}
                                            <input type="hidden" name="image" class="thumb-media" value="{{ $user->image }}" />
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  @include('backends.media.library')
@endsection