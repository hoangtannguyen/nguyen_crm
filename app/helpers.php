<?php 

use App\Models\Media;

use App\Models\Option;

include('helpers/mediaCategory.php');

include('helpers/media.php');

include('helpers/post.php');

include('helpers/page.php');



if (! function_exists('get_option')) {

	function get_option($key){

		$option = Option::select('value')->where('key', $key)->first();

		if($option) return $option->value;

			else return NULL;

	}

}





if (! function_exists('format_dateCS')) {

	function format_dateCS($date, $full = null){

		if($full==null) return date_format($date,'Y/m/d H:i:s');

			else return date_format($date,'Y/m/d');

	}

}



if (! function_exists('image')) {

	function image($id, $w, $h, $alt=''){

        $allow = array('gif','png','jpg','jpeg','JPEG','svg','PNG','JPG', 'GIF','SVG');

		$img = Media::find($id);

		if($img && in_array($img->type,$allow))

			$html = ($img->type!="svg") ? '<img src="/image/'.$img->path.'/'.$w.'/'.$h.'" alt="'.$alt.'"/>' : '<img src="'.url('uploads').'/'.$img->path.'"/>';

		else

			$html = '<img src="/image/noImage.jpg/'.$w.'/'.$h.'" alt="'.$alt.'"/>';

		return $html;

	}

}



if (! function_exists('imageAuto')) {

	function imageAuto($id, $alt){

		$image = Media::find($id);

		if(!empty($image))

			$html = '<img src="'.url('uploads').'/'.$image->path.'" alt="'.$alt.'">';

		else

			$html = '<img src="'.url('uploads').'/noImage.jpg" alt="'.$alt.'"/>';

		return $html;

	}

}


if(! function_exists('get_statusProvider')){
	function get_statusProvider(){
		return array(
			'provided' => 'Cung cấp',
			'repair' => 'Sửa chữa',
			'maintenance' => 'Bảo trì',
			'accreditation' => 'Kiểm định',
		);
	}
}


if(! function_exists('get_statusProjects')){
	function get_statusProjects(){
		return array(
			'active' => 'Đang thực hiện',
			'inactive' => 'Đã kết thúc',
		);
	}
}



if(! function_exists('get_statusEquipments')){
	function get_statusEquipments(){
		return array(
			'active' => 'Đang sử dụng',
			'inactive' => 'Đã ngưng sử dụng',
			'not_handed' => 'Chưa bàn giao',
			'was_broken' => 'Đang báo hỏng',
			'corrected' => 'Đang sửa chữa',
			'liquidated' => 'Đã thanh lý'
		);
	}
}


if(! function_exists('get_statusAction')){
	function get_statusAction(){
		return array(
			'active' => 'Đang sử dụng',
			'inactive' => 'Hết sử dụng',
		);
	}
}
