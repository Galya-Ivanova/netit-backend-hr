var jobpostIndexController = function() {
    var contentContainer      = document.getElementById("content");

    var jobpostCollectionReference = [];
    var objectCollection      = {jobpostCollection : []};

    var render = function() {
        Ajax.getJSON("posts", function(data) {

            var jobpostCollection         = [];
            jobpostCollectionReference = data
            for(var $index = 0; $index < data.length; $index++) {

                var jobElement = data[$index];

                var template = `<div class='job-posts'>
                                    <header class='post-title'>${jobElement.title}</header>
                                    <div class='employer'>${jobElement.firmname}</div>
                                    <div class='post-date'>04.05.2020</div>
                                    <div>
                                        <button class="btn btn-info" onclick="editJobPost(${$index})">Edit</button>
                                        <button class="btn btn-danger" onclick="deleteJobPost(${$index})">Delete</button>
                                    </div>
                                    <a href='#'> - </a>
                                </div>` ;

                jobpostCollection.push(template);
            }

            var jobTemplate = jobpostCollection.join('');
            contentContainer.innerHTML = jobTemplate;

        }, function() {
            console.log("GET error");
            console.log(error);            
        });
    };

    var editJobPost = function(index) {

    };

    var deleteJobPost = function(index) {

        var URLEncodedRequest = {
            job_id    : jobpostCollectionReference[index].id
        };

        Ajax.post('posts/delete', URLEncodedRequest, function() {
            render();
        });
    };

    render();

}




