<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HR system</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="style/public.css">
        <link rel="stylesheet" href="style/employer.css">
    </head>
    <body>
       
        <div id="app-header" class="page-header">
            <h1 id="web-logo-placeholder" class="logo">HR</h1>
            
            <div id="public-placeholder" class="menu-placeholder">
                <ul>
                    <li><a href="http://localhost/netit-backend-hr/index.php?index">Home</a></li>
                    <li><a href="http://localhost/netit-backend-hr/index.php?employer_registration">Company</a></li>
                    <li><a href="http://localhost/netit-backend-hr/index.php?employee_registration">Job applicant</a></li>
                    <li><a href="http://localhost/netit-backend-hr/index.php?login">Login</a></li>                     
<!--                    <li><a href="employer.php?action=logout">Log out</a></li>-->
                </ul>
            </div>
            
            
            <div id="admin-placeholder" class="menu-placeholder">
                <ul>
                    <li><a href="employer.php">Add new job</a></li>
                    <li><a href="dashboard.php">List job postings</a></li>                    
                    <li><a href="employer.php?action=logout">Log out</a></li>
                </ul>
            </div>
        </div>
       
        <div id="page-template"></div>
        
        <script src="scripts/client/netitquery.js"></script>
        <script src="scripts/vendor/jquery.js"></script>
        
        <script src="scripts/application/index/script.js"></script>
        <script src="scripts/application/employer/script.js"></script>
        <script src="scripts/application/login/script.js"></script>
        <script src="scripts/application/employee_registration/script.js"></script>
        <script src="scripts/application/employer_registration/script.js"></script>
        
        <script src="scripts/router/router.js"></script>
    </body>
</html>
