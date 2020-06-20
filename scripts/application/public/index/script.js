var indexController = function(){

    var contentContainer = document.getElementById("content");
    var menuItemPanel = document.getElementById("menu-item-panel");

    var searchInput = document.getElementById("search-jobpost");
    var searchAction = document.getElementById("search-jobpost-action");
    var clearAction = document.getElementById("clear-jobpost-action");
    var searchCombobox = document.getElementById("search-jobpost-combobox");
    var contentFullView = document.getElementById("content-fullview");
    var contentFullViewJobPost = document.getElementById("content-fullview-jobpost");
    
    //var fullviewCommentTextarea = document.getElementById("fullview-comment-textarea");
    //var fullviewCommentAction = document.getElementById("fullview-comment-action");
    
    //currently rendered jobpost
    var activeJobId = null;

    var objectCollection = {jobpostCollection : []};

    var renderFullView = function(jobId) {
        
        activeJobId = jobId;
        
        Ajax.getJSON(`posts/index/${jobId}`, function(element) {

            contentFullView.style.display = "block";
            contentFullViewJobPost.innerHTML = element[0].content;
            contentContainer.style.display = 'none';
            menuItemPanel.style.display = 'none';
        });
    }

    /**
     * 
     * @param {type} data
     * @returns {undefined}
     */

    var renderJobPost = function(data) {
        var jobpostCollection    = [];
        for(var i = 0; i < data.length; i++) {

            var jobpostElement = data[i];

            var template = `<div class='job-posts'>
                                <header class='post-title'>${jobpostElement.title}</header>
                                <div class='employer'>${jobpostElement.firmname}</div>
                                <div class='post-date'>04.05.2020</div>
                                <button class="jobpost-read-button"> Read </button>
                            </div>` ;


            //<button class="jobpost-read-button" onclick="renderFullView(${jobpostElement.id})"> Read </button>
            jobpostCollection.push(template);
        }

        var jobpostTemplate = jobpostCollection.join('');
        contentContainer.innerHTML = jobpostTemplate;
        
        var jobpostReadButtonCollection = document.getElementsByClassName('jobpost-read-button');
        for(let i = 0; i < jobpostReadButtonCollection.length; i++) {
            jobpostReadButtonCollection[i].addEventListener('click', function() {
                renderFullView(data[i].id);
                //console.log('You click me' + data[i].id);
            });
        }
    };

    /**
     * 
     * @param {type} groupId
     * @returns {undefined}
     */

    var renderAllPostsRelatedToThisGroup = function(groupId) {

        Ajax.getJSON(`posts/group/${groupId}`, function(data) {
            renderJobPost(data);
        });
    };

    searchAction.addEventListener('click', function(e) {
        var searchInputQuery = searchInput.value;
        var searchBy         = searchCombobox.value;
        Ajax.getJSON(`posts/search/?q=${searchInputQuery}&searchBy=${searchBy}`, function(data) {
            renderJobPost(data);
        });
    });

    clearAction.addEventListener('click', function() {
        Ajax.getJSON("posts", function(data) {
           renderJobPost(data);
        }, function() {
            console.log("GET error");
            console.log(error);            
        });
    });

    Ajax.getJSON('groups', function(collection) {

        var templateCollection = [];
        for(var i = 0; i < collection.length; i++) {
            templateCollection.push(`<li class="group" onclick="renderAllPostsRelatedToThisGroup(${collection[i].id})">${collection[i].title}</li>`);
        }

        menuItemPanel.innerHTML = templateCollection.join('');
    });

    Ajax.getJSON("posts", function(data) {
       renderJobPost(data);
    }, function() {
        console.log("GET error");
        console.log(error);            
    });
}


