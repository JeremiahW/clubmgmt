/**
 * Created by wangji on 11/10/2016.
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

$(".js-data-example-ajax").select2({
    ajax: {
        url: $("#requestMemberUrl").val(),
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
    $("#mid").val(selectedVal);
    getMemberInfoById();
});

function formatRepo(repo){
    console.log(repo)
    if (repo.loading) return repo.text;
    return repo.chinese;
    // return "<div>"+repo.chinese+"</div>";
};

function formatRepoSelection(repo){
    return repo.chinese || repo.text;
};





 function getMemberInfoById() {
     $.ajax({
         url:$("#requestMemberByIdUrl").val(),
         type:"POST",
         dataType:"json",
         data:{"id":$("#mid").val()},
         success:function (result) {
             if(result.num == "1"){
                 console.log(result);
                 $("#chinese").val(result.data[0].chinese);
                 $("#gender").val(result.data[0].gender);

                 $("#birthdate").val(result.data[0].birthdate);
                 $("#phone").val(result.data[0].phone);
                 $("#email").val(result.data[0].email);
                 $("#shenfenzheng").val(result.data[0].shenfenzheng);
                 $("#address").val(result.data[0].address);
                 $("#clothsize").val(result.data[0].clothsize);
                 $("#bloodtype").val(result.data[0].bloodtype);

                 $("#emergencycontactname").val(result.data[0].emergencycontactname);
                 $("#emergencycontactphone").val(result.data[0].emergencycontactphone);

                 $("#mid").val(result.data[0].id);

             }

         }
     });
 }

