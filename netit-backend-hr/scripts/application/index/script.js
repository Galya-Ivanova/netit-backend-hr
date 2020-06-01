var indexScript = function(){

    var contentContainer = document.getElementById("content");
    var menuItemPanel = document.getElementById("menu-item-panel");

    var searchInput = document.getElementById("search-jobpost");
    var searchAction = document.getElementById("search-jobpost-action");
    var clearAction = document.getElementById("clear-jobpost-action");
    var searchCombobox = document.getElementById("search-jobpost-combobox");
    var contentFullView = document.getElementById("content-fullview");
    var contentFullViewJobPost = document.getElementById("content-fullview-jobpost");

    var objectCollection = {jobCollection : []};

    var renderFullView = function(jobId) {
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
        var jobCollection    = [];
        for(var i = 0; i < data.length; i++) {

            var jobElement = data[i];

            var template = `<div class='job-posts'>
                                <header class='post-title'>${jobElement.title}</header>
                                <div class='employer'>${jobElement.firmname}</div>
                                <div class='post-date'>04.05.2020</div>
                                <button onclick="renderFullView(${jobElement.id})"> Read </button>
                            </div>` ;

            jobCollection.push(template);
        }

        var jobTemplate = jobCollection.join('');
        contentContainer.innerHTML = jobTemplate;
    }

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


