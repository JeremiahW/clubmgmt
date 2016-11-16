/**
 * Created by wangji on 11/16/2016.
 */

$(".js-data-example-ajax").select2({
    ajax: {
        url: $("#getMemberUrl").val(),
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                chinese: params.term,
            };
        },
        processResults: function (data, params) {
            return {
                results: data
            };
        },
        cache: true,
    },
    language: "zh-CN",
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo, // omitted for brevity, see the source of this page
    templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
}).on("select2:select", function (e) {
    var selectedVal = $(e.currentTarget).val();
    $("#uid").val(selectedVal);
    //get list

    $('#table').bootstrapTable('refresh', { url:$("#getGroupUrl").val()});
});

function formatRepo(repo){
    if (repo.loading) return repo.text;
    return repo.chinese;
    // return "<div>"+repo.chinese+"</div>";
};

function formatRepoSelection(repo){
    return repo.chinese || repo.text;
};

$('#table').bootstrapTable({
    columns:[{
        checkbox:true,

    },  {
        field:'id',
        title:"#"
    }, {
        field:'subject',
        title:"分组名称"
    } ],
    onLoadSuccess:function (data) {
        $.ajax({
            url:$("#getGroupUrl").val(),
            type:"POST",
            dataType:"json",
            data:{'uid':$("#uid").val()},
            success:function (result) {
                $.each(result, function () {
                    console.log(this.gid);
                    for(var i=0;i<data.length;i++){
                        if(data[i].id==this.gid){
                            $('#table').bootstrapTable("check", i);
                        }
                    }
                });
            }

        });


    }

});

$("#btnSubmit").on("click", function () {

    console.log($("#uid").val());
    $.ajax({
        url:$("#addUserUrl").val(),
        type:"POST",
        dataType:"json",
        data:{'groups':$('#table').bootstrapTable('getSelections'), 'uid':$("#uid").val()},
        success:function (result) {
            console.log(result);
        }

    });
});
