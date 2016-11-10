/**
 * Created by wangji on 11/9/2016.
 */
$('.form_date').datetimepicker({
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
CKEDITOR.replace('description',{
    toolbar : 'Standard',
    //uiColor : '#9AB8F3',
    height:'200'
});

CKEDITOR.replace('summary',{
    toolbar : 'Standard',
    //uiColor : '#9AB8F3',
    height:'200'
});