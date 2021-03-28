@extends('backends.templates.master')
@section('title', __('Bảo dưỡng định kỳ'))
@section('content')
@php 
$get_statusAction = get_statusAction();
@endphp
<div id="list-events" class="content-wrapper events">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Bảo dưỡng định kỳ') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                  <li class="active"><a href="{{ route('periodic.index') }}">{{ __('Tất cả') }}</a></li>
                  <li class=""><a class="btn btn-success" style="color: #fff;" href="{{ route('periodic.create') }}">{{ _('Thêm mới') }}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form action="{{ route('periodic.index') }}" method="GET">
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
                           <th>{{ __('Id') }}</th>
                           <th>{{ __('Ảnh đại diện') }}</th>
                           <th>{{ __('Tên thiết bị') }}</th>
                           <th>{{ __('Mã hiển thị') }}</th>
                           <th>{{ __('Người nhập') }}</th>
                           <th>{{ __('Nội dung') }}</th>
                           <th>{{ __('Trạng thái') }}</th>
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if(!$periodics->isEmpty())
                        @foreach($periodics as $key => $periodic)
                     <tr>
                        <td>{{  ++$key}}</td>
                        <td class="image"><a href="{{ route('periodic.edit' , $periodic->id )}}">{!! image($periodic->image, 100,100) !!}</a></td>
                        <td>
                           {{ $periodic->action_equipment->title }}
                        </td>
                        <td>{{ $periodic->code}}</td>
                        <td>{{ $periodic->action_user->name}}</td>
                        <td>{!! $periodic->content !!}</td>
                        <td>{{ $get_statusAction[$periodic->status]}}</td>
                        <td class="group-action text-right">
                          <a class="btn btn-info btn-sm" href="{{ route('periodic.edit' , $periodic->id )}}"><i class="fas fa-pencil-alt"></i>{{__('Sửa')}}</a>
                        </td>                       
                        <td>  
                           <a class="btn btn-danger btn-sm" href="{{ route('periodic.delete',$periodic->id ) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{__('Xóa')}}</a>
                        </td>
                     </tr>
                        @endforeach
                        @else
                        <tr>
                           <td colspan="8">{{ __('No items!') }}</td>
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