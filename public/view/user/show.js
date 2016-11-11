/**
 * Created by wangji on 11/11/2016.
 */
$("#checkAll").on("click", function () {

    $(".selectedMember").prop("checked",$("#checkAll").is(":checked") );

});


$("#btnSubmit").on("click", function () {
    $(".selectedMember").each(function () {
        if($(this).is(":checked")) {
            console.log($(this).val());
        }
    });
 });