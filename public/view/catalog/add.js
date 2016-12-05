/**
 * Created by wangji on 12/2/2016.
 */

$(function () {
    $('[data-toggle="popover"]').popover();
    $("<style type='text/css'> .popover{z-index:1060;} </style>").appendTo("head");
})

$("#btnSubmit").on("click", function () {
    $.ajax({
       type:"POST",
        url:"/clubmgmt/public/index.php/index/catalog/save",
        data:$("#frmCatalog").serialize(),
        success:function (response) {
            var message = "";
            if(response.result == true){
                message = response.message;
            }
            else{
                Object.keys(response.message).map(function (key) {
                    message += response.message[key] + ";"
                })
            }
            var popover = $('#btnSubmit').attr('data-content',message).data('bs.popover');
            popover.setContent();
            popover.$tip.addClass(popover.options.placement);
        }
    });
})

$(".btnEdit").on("click", function () {
    var id = this.id;
    $.ajax({
        type:"POST",
        url:"/clubmgmt/public/index.php/index/catalog/get",
        data:{"id":id},
        success:function (response) {
            if(response.result == true){
                $("#id").val(response.data.id);
                $("#subject").val(response.data.subject);
                $("#seqno").val(response.data.seqno);
                $("#pid").val(response.data.pid);
                console.log(response.data);
            }
        }
    });
})