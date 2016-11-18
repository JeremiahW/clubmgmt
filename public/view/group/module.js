/**
 * Created by wangji on 11/16/2016.
 */
$("#group").on("change",function () {
    var url = $("#requestUrl").val() + "?groupid="+this.value;
    $('#table').bootstrapTable('refresh', { url:url});
});

$('#table').bootstrapTable({
    columns:[{
        checkbox:true,

    },  {
        field:'id',
        title:"#"
    }, {
        field:'subject',
        title:"显示名称"
    }, {
        field:'module',
        title:"模块"
    },{
        field:'controller',
        title:"控制器"
    },{
        field:'action',
        title:"Action"
    }],
    onLoadSuccess:function (data) {
        $.ajax({
            url:$("#selectedModuleUrl").val(),
            type:"POST",
            dataType:"json",
            data:{'groupid':$("#group").val()},
            success:function (result) {
                $.each(result, function () {
                    console.log(this.mid);
                     for(var i=0;i<data.length;i++){
                         if(data[i].id==this.mid){
                             $('#table').bootstrapTable("check", i);
                         }
                     }
                 });
            }

        });


    }

});

$("#btnSubmit").on("click", function () {

    console.log($("#group").val());
    $.ajax({
        url:$("#saveUrl").val(),
        type:"POST",
        dataType:"json",
        data:{'modules':$('#table').bootstrapTable('getSelections'), 'groupid':$("#group").val()},
        success:function (result) {
            console.log(result);
        }

    });
});
