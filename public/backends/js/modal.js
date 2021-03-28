(function($) {
    'use strict';
    $(".dev-form .btn-danger").click(function(){
        var $direction = $(this).attr("data-direct");
        if($(".modal-del .modal-dialog").hasClass($direction)==false){
            $(".modal-del .modal-dialog").addClass($direction);
        }
        $(".modal-del form").attr("action",$(this).attr("href"));
    });
})(jQuery);