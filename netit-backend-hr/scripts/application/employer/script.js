var employerScript = function() {

    var adminPostEditorCategory = document.getElementById("admin-post-editor-category");
    var jobPostTitle            = document.getElementById("jobs_title");
    var jobPostFirmname         = document.getElementById("firmname");
    var jobPostContent          = document.getElementById("jobs_content");
    var jobPostCategory         = document.getElementById("admin-post-editor-category");


    Ajax.getJSON('groups', function(collection) {

        var templateCollection = [];
        for(var i = 0; i < collection.length; i++ ) {
            templateCollection.push(`<option name="job_category value="${collection[i].id}">${collection[i].title}</option>`);
        }

        adminPostEditorCategory.innerHTML = templateCollection.join('');

    });

    var submitForm = function() {

        var request = {
           job_title    : jobPostTitle.value,
           firmname     : jobPostFirmname.value,
           jobs_content : jobPostContent.value,
           job_group    : jobPostCategory.value

        };

        Ajax.post('posts/create', request, function(collection) {
           console.log(collection);
        });
    };
}




