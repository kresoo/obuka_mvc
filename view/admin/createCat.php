<div id="welcome">
    <h3>Hello <?php echo $admin; ?>,&nbsp;<a href="logout" style="color:#2CB7F2;text-decoration: none;">  Logout </a> </h3><br /><br />
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
        <form action="createCat" method="POST">
            Create new category:  <br /> <hr />
            Name: <br/>
            <input type="text" name="name" />
            <input type="submit" name="create_category" value="Save" />
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
