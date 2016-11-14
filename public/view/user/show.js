/**
 * Created by wangji on 11/11/2016.
 */
$("#checkAll").on("click", function () {

    $(".selectedMember").prop("checked",$("#checkAll").is(":checked") );

});


$("#btnSubmit").on("click", function () {
    setStatus("isApproval", getSelectedIds(),  $("#isApproval").val());
 });


$("#btnPaid").on("click", function () {
    setStatus("isPaid", getSelectedIds(), $("#isPaid").val());
});

function getSelectedIds() {
    var ids = [];
    $(".selectedMember").each(function () {
        if($(this).is(":checked")) {
            var id = {};
            id["id"] =  $(this).val();
            ids.push(id);
        }
    });
    return JSON.stringify(ids);
}

function setStatus(col, ids, val) {
    $.ajax({
        url:$("#requestUrl").val(),
        type:"POST",
        dataType:"json",
        data:{'ids':ids, val:val, col:col},
        success:function (result) {
            console.log(result);

            location.reload(false);
         }

    });
}