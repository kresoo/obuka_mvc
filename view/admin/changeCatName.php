<div id="welcome">
    <h3>Hello <?php echo $admin; ?>,&nbsp;<a href="logout" style="color:#2CB7F2;text-decoration: none;">  Logout </a> </h3><br /><br />
</div>
<div id="navigation">
    Options:
    <ul>
        <li><a href="/admin/allCat" style="text-decoration: none;"> All categories </a><br /></li>
        <li><a href="/admin/allProd" style="text-decoration: none;"> All products </a><br /></li>
        <li><a href="/admin/createCat" style="text-decoration: none;"> Create category </a><br /></li>
        <li><a href="/admin/createProd" style="text-decoration: none;"> Create product </a></li>
        <li><a href="/admin/viewAllOrders" style="text-decoration: none;"> View all orders </a></li>
        <li><a href="/admin/searchOrders" style="text-decoration: none;"> Search orders </a></li>
    </ul>
</div>
<div>
    <div id="main">
        <form action="changeCatName" method="POST">
            New name: <br /> <hr style=""/>
            <input type="text" name="category_name" value="<?php echo $category->name ?>"/>
            <input type="hidden" name="category_id" value="<?php echo $category->id ?>" />
            <input type="submit" name="category_change" value="Save" />
        </form>

        <div>
            <?php
            if(!empty($_SESSION['errors'])){
                foreach ($_SESSION['errors'] as $error){
                    echo $error ."<br />";
                }
                unset($_SESSION['errors']);
            }
            ?>
        </div>
    </div>
</div>
