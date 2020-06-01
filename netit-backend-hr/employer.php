<?php
    include './autoload.php';
    
    (new controllers\EmployerController())->index();
?>

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
        
        <div id="admin-header" class="page-header">
            <h1 class="logo">EMPLOYER</h1>
            <div id="admin-header-placeholder">
                <ul>
                    <li><a href="employer.php">Add new job</a></li>
                    <li><a href="dashboard.php">List job postings</a></li>                    
                    <li><a href="employer.php?action=logout">Log out</a></li>
                </ul>
            </div>
        </div>
        
        <?php
            if(\session\Session::checkFlashMessage('create_job_post')) {

                echo '<div class="message success">';
                echo \session\Session::getFlashMessage('create_job_post');
                echo '</div>';
            }

        ?>
        
        <div id="admin-editor">
            <form method="POST" name="admin-jobs-editor">
                <input class="form-input" type="text" placeholder="Jobs title"  name="admin-jobs-editor_jobs_title" id="jobs_title">
                <input class="form-input" type="text" placeholder="Firmname"  name="admin-jobs-editor_firmname" id="firmname">
                <textarea class="form-textarea h-150" placeholder="Jobs content" name="admin-jobs-editor_jobs_content" id="jobs_content"></textarea>
<!--                <input class="button" type="submit" name="jobs_submit">-->
                
                <select " id="admin-post-editor-category">
                     <option value="1">Category 1</option>
                </select>
                
                <input type="hidden" name="post_tokken" value="1">
                <input class="button" type="button" onclock="submitForm()" name="jobs_submit">
            </form>
        </div>
        
        <script src="scripts/client/netitquery.js"></script>
        <script src="scripts/vendor/jquery.js"></script>
        <script src="scripts/application/employer/employer.js"></script>
    </body>
</html>



