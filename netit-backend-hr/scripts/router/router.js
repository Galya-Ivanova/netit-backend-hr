var pageSearchCollection = window.location.search.split('?');
var loadPage             = pageSearchCollection[1] ? pageSearchCollection[1] : 'index';

var pageTemplateContainer = document.getElementById("page-template");
var webLogoPlaceholder = document.getElementById("web-logo-placeholder");
var publicMenu = document.getElementById('public-placeholder');
var adminMenu = document.getElementById('admin-placeholder');


var ScriptReference = {
    employer : {
        script   : employerScript,
        isPublic : false,
        title : 'HR'
    },
    index    : {
        script   : indexScript,
        isPublic : true,
        title : 'HR Home'
    },
    employee_registration : {
        script   : employeeRegistrationScript,
        isPublic : true,
        title : 'HR'
    },
    employer_registration : {
        script   : employerRegistrationScript,
        isPublic : true,
        title : 'HR'
    },
    login : {
        script   : loginScript,
        isPublic : true,
        title : 'HR'
    }
};


var xmlHttpRequest  = new XMLHttpRequest();
    var requestMethod   = "GET";
    //var isJSONRequest   = isJSONRequest || false;

    var url           = `http://localhost/netit-backend-hr/scripts/application/${loadPage}/template.html`;
    //var requestObject = requestTransform(requestObject);

    xmlHttpRequest.open(requestMethod, url);
    //xmlHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xmlHttpRequest.send(null);

    xmlHttpRequest.onreadystatechange = function() {


       var statusGroup                  = ((this.status).toString())[0];

       var HTTPStatus = {
           SUCCESS  : (statusGroup == 2),
           FAIL     : (statusGroup == 4 || statusGroup == 5)
       };

       var isHTTPRequestProccesed       = (this.readyState == xmlHttpRequest.DONE);
       var isHTTPRequestSuccessful      = isHTTPRequestProccesed && HTTPStatus.SUCCESS;
       var isHTTPRequestFailed          = isHTTPRequestProccesed && HTTPStatus.FAIL;
     
       if(isHTTPRequestSuccessful){
           
           var pageReference = ScriptReference[loadPage];
           pageTemplateContainer.innerHTML = this.responseText;
           pageReference.script();
           
           adminMenu.style.display = pageReference.isPublic ? 'none' : 'block';
           
           publicMenu.style.display = pageReference.isPublic ? 'block' : 'none';
           
           webLogoPlaceholder.innerHTML = pageReference.title;
       };
       
       if(isHTTPRequestFailed && this.status == 404) {
           pageTemplateContainer.innerHTML = "Sorry page not found";
           
       }
   };
