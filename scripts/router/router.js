var pageSearchCollection = window.location.search.split('?');
var loadPage             = pageSearchCollection[1] ? pageSearchCollection[1] : 'index';

var pageTemplateContainer = document.getElementById("page-template");
var webLogoPlaceholder    = document.getElementById("web-logo-placeholder");
var publicMenu            = document.getElementById('public-placeholder');
var employerMenu          = document.getElementById('employer-placeholder');

//maping
var ScriptReference = {
    
    "index"      : {
        script   : indexController,
        isPublic : true,
        title    : 'HR : Home'        
    },
    "employee_registration" : {
        script   : employeeRegistrationController,
        isPublic : true,
        title    : 'HR : EMPLOYEE'
    },
    "employer_registration" : {
        script   : employerRegistrationController,
        isPublic : true,
        title    : 'HR : EMPLOYER'
    },
    "login"      : {
        script   : loginController,
        isPublic : true,
        title    : 'HR : LOGIN'
    },
    "jobpost" : {
        script   : jobpostIndexController,
        isPublic : false,
        isIndex  : true,
        title    : 'HR : Jobpost'
    },
    
    "jobpost/create" : {
        script   : jobpostCreateController,
        isPublic : false,
        title    : 'HR : Jobpost Create'
    },
    "group" : {
        script   : groupIndexController,
        isPublic : false,
        isIndex  : true,
        title    : 'HR : Group'
    },
    
    "group/create" : {
        script   : groupCreateController,
        isPublic : false,
        title    : 'HR : Group Create'
    },
    
    "404" : {
        script   : page404Controller,
        isPublic : true,
        title    : 'Page not found'
    }
};

//check if request is processable
//Ajax.getJSON('');

var xmlHttpRequest  = new XMLHttpRequest();
var requestMethod   = "GET";
//var isJSONRequest   = isJSONRequest || false;

loadPage             = ScriptReference[loadPage] ? loadPage : "404";

var directory        = ScriptReference[loadPage].isPublic ? 'public' : 'admin';
var path             = ScriptReference[loadPage].isIndex ? '/index' : '';
var url              = `http://localhost/netit-backend-hr/scripts/application/${directory}/${loadPage}${path}/template.html`;

xmlHttpRequest.open(requestMethod, url);  
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
 
       pageReference = ScriptReference[loadPage];
       
       //check if the page is public
       if(!pageReference.isPublic) {

           if(!UserService.hasPermitionToAccessThisResource(loadPage)) {

               window.location.href = "http://localhost/netit-backend-hr/index.html?login";
               return;
           }
       }

       
       pageTemplateContainer.innerHTML = this.responseText;
       pageReference.script();

       employerMenu.style.display = pageReference.isPublic ? 'none' : 'block';

       publicMenu.style.display = pageReference.isPublic ? 'block' : 'none';

       webLogoPlaceholder.innerHTML = pageReference.title;
   };

   if(isHTTPRequestFailed && this.status == 404) {
       pageTemplateContainer.innerHTML = "Sorry page not found";

   }
   };
