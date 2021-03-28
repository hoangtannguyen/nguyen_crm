(function($) {
    $('#openTime').datetimepicker({
        format: 'HH:mm',
    });
    $('#closeTime').datetimepicker({
        format: 'HH:mm',
    });
    $('#startDate').datetimepicker({
        format: 'YYYY/MM/DD',
        locale: 'ko',
    });
    $('#endDate').datetimepicker({
        format: 'YYYY/MM/DD',
        locale: 'ko',
    });
    $('.select2').select2();
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
})(jQuery);