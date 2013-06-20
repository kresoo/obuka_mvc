<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link type="text/css" href="/css/jquery.css" rel="stylesheet" />
        <link type="text/css" href="/css/bootstrap.min.css" rel="stylesheet" />
        <link type="text/css" href="/css/main.css" rel="stylesheet" />
    </head>
    <body>
            <?php 
                if(isset($admin_html)){
                    require_once $admin_html;
                } 
            ?>
                <div id="main">
                    <?php echo $content ?>
                </div>
            </div>
        <script src="/js/jquery.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>