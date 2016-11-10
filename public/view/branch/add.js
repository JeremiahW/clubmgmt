/**
 * Created by wangji on 11/7/2016.
 */
$(".js-data-example-ajax").select2({
     ajax: {
        url: $("#requestUrl").val(),
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
    $("#supervisor").val(selectedVal);
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

CKEDITOR.replace('description',{
    toolbar : 'Standard',
    //uiColor : '#9AB8F3',
    height:'200'
});


