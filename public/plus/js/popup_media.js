(function($) {
	'use strict';
	/**
	 * library
	 */
	$(".dev-form").on('click','.library',function(e){
		e.preventDefault();
		$("#library-op #file-detail").empty();
		var _token = $(".dev-form input[name='_token']").val();
		var link = $(this).attr("href");
		var tag_id = $(this).parents(".img-upload").attr("id");
		$("#library-op .modal-footer .btn-primary").attr("id",tag_id);
		// $(".loading").show();
		$.ajax({
			type:'POST',
			url:link,
			cache: false,
			data:{
				'_token': _token
			},
			success:function(data){
				// $(".loading").hide();
				if(data.message != 'error'){
					$('#library-op .modal-body #files .list-media').html(data.html);
					$("#library-op #files .limit").val(data.limit);
					$("#library-op #files .current").val(data.current);
					$("#library-op #files .total").val(data.total);
					$("#library-op").modal('toggle');
				}
			}
		})
		return false;
	});
	//load more media
	var total = 0;
	var current = 0;
	var limit = 0;
	$("#library-op #files").scroll(function(){
		var _token = $(".dev-form input[name='_token']").val();
		var mediaCatId = $("#library-op #media-cat .dropdown-toggle").attr("data-value");
		var s = $("#library-op #media-find input").val();
		total = parseInt($("#library-op #files .total").val());
		current = parseInt($("#library-op #files .current").val());
		limit = $("#library-op #files .limit").val();
		if(total>current){
			if($("#library-op #files").scrollTop() + $("#library-op #files").height()>= $("#library-op .list-media").height() + 10) {
				$.ajax({
					type:'POST',
					url:$("#library-op .more-media").val(),
					cache: false,
					data:{
						'_token': _token,
						'catId': mediaCatId,
						's': s,
						'limit': $("#library-op #files .limit").val(),	
						'current': $("#library-op #files .current").val(),
					},
					success:function(data){
						if(data!="error"){
							total = data.total;
							current = data.current
							$('#library-op .modal-body #files .list-media').append(data.html);
							$("#library-op #files .limit").val(data.limit);
							$("#library-op #files .current").val(data.current);
							$("#library-op #files .total").val(data.total);
						}
					}
				});
		    }
	    }
	});
    $("#library-op #files").on("click",".modal-body li a",function(){
        var tab = $(this).attr("href");
        $(".modal-body .tab-content div").each(function(){
            $(this).removeClass("in active");
        });
        $(".modal-body .tab-content "+tab).addClass("in active");
    });
	//change thumbnail
	$("#library-op .modal-footer").on('click','.btn-primary',function(){
		$("#library-op .modal-footer .library-notify").empty();
		var img_url = $("#library-op .modal-body li.active img").attr("src");
		var img_alt = $("#library-op .modal-body li.active img").attr("alt");
		var img_id = $(".list-media li.active").attr("id").split("-");
		var tag_id = $(this).attr("id");
		if(img_url === undefined){
			$("#library-op .modal-footer .library-notify").text("Please choose file!!");
		}else{
			$(".dev-form #"+ tag_id+ " img").attr("src", img_url);
			$(".dev-form #"+ tag_id+ " .thumb-media").val(img_id[1]);
			$("#library-op").modal('toggle');
			$(".modal-backdrop").modal('toggle');
		}
		return false;
	})
	//detail media file
	$("#library-op.single .modal-body").on('click', '.list-media li', function(){
		$(".list-media li").removeClass("active");
		$(this).addClass('active');
		var img_link = $(".list-media li.active img").attr("data-image");
		var img_alt = $(".list-media li.active img").attr("alt");
		var img_date = $(".list-media li.active img").attr("data-date");
		var img_id = $(".list-media li.active").attr("id").split("-");
		var html ="<div class='wrap'>";
			html += "<div class='card card-primary'>";
				html += "<div class='card-header'>";
					html += "<h3 class='card-title'>첨부파일 상세</h3>";
					html += '<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button></div>';
				html += '</div>';
				html += '<div class="card-body">';
					html += "<div class='wrap-img'><img src='"+img_link+"' alt='"+img_alt+"'/></div>";
					html +="<h4>"+img_alt+"</h4>";
					html +="<p class='date'>"+img_date+"</p>";
					html +="<a href='#' class='delete' id='"+img_id[1]+"'>영구 삭제</a>";
				html += '</div>';
			html +="</div>";
		html +="</div>";
		$("#library-op #file-detail").html(html);
	});
	
	//delete media
	$("#library-op #file-detail").on('click', '.delete', function(){
		var _token = $("#library-op .tab-content #media input[name='_token']").val();
		var id = $(this).attr("id");
		var link = $("#library-op .tab-content #media form").attr("action");
		$.ajax({
			type:'POST',
			url:link,
			cache: false,
			data:{
				'_token': _token,
				'id': id
			},
			success:function(data){
				if(data!="error"){
					$("#library-op .modal-body #image-"+id).remove();
					$("#library-op #file-detail").empty();
					if(data!="success"){
						$("#avatar img").attr("src", data);
					}
				}
			}
		})
		return false;
	});
})(jQuery);