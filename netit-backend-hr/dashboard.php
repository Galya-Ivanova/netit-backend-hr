<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HR system</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="style/employer.css">
    </head>
    <body>
        
        <div id="admin-header">
            <h1 class="logo">EMPLOYER</h1>
            <div id="admin-header-placeholder">
                <ul>
                    <li><a href="employer.php">Add new job</a></li>
                    <li><a href="dashboard.php">List job postings</a></li>
                    <li><a href="employer.php?action=logout">Log out</a></li>
                </ul>
            </div>
        </div>
        
        <div id="content" class="component"></div>
        
        <script src="scripts/client/netitquery.js"></script>
        <script src="scripts/vendor/jquery.js"></script>
        <script src="scripts/application/employer/dashboard.js"></script>
    </body>
</html>
