<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link type="text/css" href="/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="/css/main.css" rel="stylesheet" />
    </head>
    <body>
        <div class ="container">
            <?php
            if (isset($admin_html)) {
                require_once $admin_html;
            }
            ?>
            
                <?php echo $content ?>
                          
        </div>

        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.cookie.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>