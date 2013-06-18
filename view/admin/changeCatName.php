<div id="welcome">
    <h3>Hello <?php  ?>,&nbsp;<a href="admin/logout.php" style="color:#2CB7F2;text-decoration: none;">  Logout </a> </h3><br /><br />
</div>
<div id="navigation">
    Options:
    <ul>
        <li><a href="allCat" style="text-decoration: none;"> All categories </a><br /></li>
        <li><a href="allProd" style="text-decoration: none;"> All products </a><br /></li>
        <li><a href="createCat" style="text-decoration: none;"> Create category </a><br /></li>
        <li><a href="createProd" style="text-decoration: none;"> Create product </a></li>
        <li><a href="viewAllOrders" style="text-decoration: none;"> View all orders </a></li>
        <li><a href="searchOrders" style="text-decoration: none;"> Search orders </a></li>
    </ul>
</div>
<div>
    <div id="main">
        <form action="changeCat" method="POST">
            New name: <br /> <hr style=""/>
            <input type="text" name="category_name" value="<?php echo $category->name ?>"/>
            <input type="hidden" name="category_id" value="<?php echo $category->id ?>" />
            <input type="submit" name="category_change" value="Save" />
        </form>
    </div>
</div>
