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
            <h1 class="logo">ADMIN</h1>
            <div id="admin-header-placeholder">
                <ul>
                    <li>Add new</li>
                    <li>List job postings</li>                
                    <li><a href="employer.php?action=logout">Log out</a></li>
                </ul>
            </div>
        </div>
        
        <div id="message-banner" class="message success">
            Записът е изпратен успешно
        </div>
        
        <div class="admin-editor">
            <form id="admin-group-editor" method="POST" name="admin-group-editor">
                <input id="group-title" class="form-input" type="text" placeholder="Group title"  name="group_title">
                <input id="admin-group-editor-submit" class="button" type="submit" name="group_submit">  
                <input id="admin-group-editor-edit-cancel" class="button" type="button" value="cancel edit" name="group_cancel">
                <input type="hidden" name="post_tokken" value="1">
            </form>
        </div>
        
        <div id="group-container" class="admin-editor">
            
        </div>
        
        <script src="scripts/client/netitquery.js"></script>
        <script src="scripts/vendor/jquery.js"></script>
        <script src="scripts/application/groups.js"></script>
    </body>
</html>



