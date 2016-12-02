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
            if(response.result == true){

            }
            console.log(response.message)
        }
    });
})