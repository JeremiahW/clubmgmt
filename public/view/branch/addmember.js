/**
 * Created by wangji on 11/8/2016.
 */
$("#btnAdd").click(function (e) {
    $.ajax({
        url:$("#postUrl").val(),
        type:"POST",
        dataType:"json",
        data:{members:$("#table").bootstrapTable('getSelections')},
        success:function (result) {
            console.log(result.result);
            $('#table').bootstrapTable('refresh', { url: $("#requestUrl").val()});
        }

    });
 });

$('#table').bootstrapTable({
    url: $("#requestUrl").val(),

});

function formatDate(value){
    if(value.length > 10)
        return value.substr(0,10);
    else
        return value;
};

function formatGender(value) {
    if(value == "1")
        return "男";
    else
        return "女";
};