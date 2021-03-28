@extends('backends.templates.master')
@section('title',__('Thêm file'))
@section('content')
<?php $mediaCats = get_mediaCategoreis();?>
<div id="create-media" class="page">
	<div class="head">
		<a href="{{route('mediaAdmin')}}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
		<h1 class="title">{{ __('Thêm file') }}</h1>
	</div>
	<div id="dropzone">	
		<div class="row">
			<div class="col-md-3 sidebar clearfix">
				<section id="sb-mediaCat" class="box-wrap">
					<h2 class="title">{{ __('Categories') }}</h2>
					@if(isset($mediaCats))
					<div class="desc list">
						@foreach($mediaCats as $item)
						<div class="checkbox checkbox-success item">
							<input id="item-{{$item->id}}" type="checkbox" name="mediaCats[]" value="{{$item->id}}">
							<label for="item-{{$item->id}}">{{$item->title}}</label>
						</div>
						@endforeach
					</div>
					@endif
				</section>
			</div>
			<div class="col-md-9 content clearfix">
				<form action="{{ route('createMediaAdmin') }}" class="dropzone" id="frmTarget">
					{!! csrf_field() !!}
					<input type="hidden" name="category" id="category" value="">
				</form>
				<div class="group-action text-right mt-2">
					<button id="submit" type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
					<a href="{{route('mediaAdmin')}}" class="btn btn-secondary">{{ __('Cancel') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		Dropzone.options.frmTarget = {
		    autoProcessQueue: false,
		    // uploadMultiple: true,
  			parallelUploads: 100,
		    maxFiles:100,
		    url: '{{ route("createMediaAdmin") }}',
		    init: function () {
		        var myDropzone = this;
		        // Update selector to match your button
		        $("#dropzone button").click(function (e) {
		            e.preventDefault();
		            var cat_ids = new Array();
		            $("#sb-mediaCat .checkbox").each(function(){
		            	if($(this).find("input").is(":checked")){
		            		cat_ids.push($(this).find("input").val());
		            	}
		            });
		            $("#category").val(cat_ids.toString());
		            myDropzone.processQueue();
		        });

		        this.on('sending', function(file, xhr, formData) {
		            var data = $('#frmTarget').serializeArray();
		            var category = $("#category").val();
		            formData.append('category', name);
		           	$.each(data, function(key, el) {
		                formData.append(el.name, el.value);
		            });
		        });
		        this.on("complete", function(file) {
				  myDropzone.removeFile(file);
				});
		    }
		}		
	});
</script>
@stop