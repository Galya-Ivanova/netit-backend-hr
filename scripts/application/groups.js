var employerGroupEditorForm           = document.getElementById("employer-group-editor");
var employerGroupEditorFormSubmit     = document.getElementById("employer-group-editor-submit");
var employerGroupEditorFormEditCancel = document.getElementById("employer-group-editor-edit-cancel");
var groupTitleInput                = document.getElementById("group-title");
var messageBanner                  = document.getElementById("message-banner");
var groupContainer                 = document.getElementById("group-container");

messageBanner.style.display                  = "none";
employerGroupEditorFormEditCancel.style.display = "none";

var groupId                  = null;
var groupCollectionReference = [];





var renderGroup = function() {
    
    Ajax.getJSON('groups', function(collection) {
        groupCollectionReference = collection;
        renderGroupContainer(groupCollectionReference);
    });
};
var renderGroupContainer = function(collection) {
    
    var templateCollection = [];
    for(var $index = 0; $index < collection.length; $index++) {
        var element = collection[$index];
        var template = `
                 <div class="mt-2">
                       <div class="container">
                          <div class="row">
                            <div class="col-sm">
                                <span>${element.title}</span>
                            </div>
                            <div class="col-sm">
                                <button class="btn btn-info" onclick="editGroup(${$index})">Edit</button>
                            </div>
                            <div class="col-sm">
                                <button class="btn btn-danger" onclick="deleteGroup(${$index})">Delete</button>
                            </div>
                          </div>
                        </div>
                 </div>`;
        templateCollection.push(template);
    
    }
    groupContainer.innerHTML = templateCollection.join('');
};

var editGroup = function(index) {
    groupTitleInput.value                        = groupCollectionReference[index].title;
    groupId                                      = groupCollectionReference[index].id;
    employerGroupEditorFormSubmit.value             = "EDIT";
    employerGroupEditorFormEditCancel.style.display = "inline-block";
};

var deleteGroup = function(index) {

    var URLEncodedRequest = {
        group_id    : groupCollectionReference[index].id
    };
    
    Ajax.post('groups/delete', URLEncodedRequest, function() {
        renderGroup();
    }, function() {
       console.log("Error"); 
    });    
};

renderGroup();

employerGroupEditorFormEditCancel.addEventListener('click', function() {
    
    employerGroupEditorFormSubmit.value             = "SUBMIT";
    employerGroupEditorFormEditCancel.style.display = "none";
    groupId                                      = null;
});


employerGroupEditorForm.addEventListener('submit', function(e) {
    
    e.preventDefault();
    
    var groupTitleInputValue = groupTitleInput.value;
    
    if(groupTitleInputValue.length < 3) {
        alert("Трябва да напишете 3 символа");
        return;
    }

    var URLEncodedRequest = {
        group_id    : groupId,
        group_title : groupTitleInputValue
    };
    
    if(groupId) {
        Ajax.post('groups/update', URLEncodedRequest, function(collection) {
     
            //success message
            messageBanner.style.display = "block";
            groupTitleInput.value       = "";

            groupCollectionReference.push(collection[0]);
            renderGroupContainer(groupCollectionReference);

            //fade out
            setTimeout(function() {
                messageBanner.style.display = "none";
            }, 3000);
        }, function() {
           console.log("Error"); 
        });
    }
    else {
        Ajax.postJSON('groups/create', URLEncodedRequest, function(collection) {
     
            //success message
            messageBanner.style.display = "block";
            groupTitleInput.value       = "";

            groupCollectionReference.push(collection[0]);
            renderGroupContainer(groupCollectionReference);

            //fade out
            setTimeout(function() {
                messageBanner.style.display = "none";
            }, 3000);
        }, function() {
           console.log("Error"); 
        });
    }
       
});