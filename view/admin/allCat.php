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
        <table class="display">
            <?php foreach ($params as $category) {
                ?>
                <tr>
                    <td> <?php echo $category->name; ?> </td> 
                    <td> <a href="/admin/changeCatName?cid=<?php echo $category->id ?>"  > <b> Change name </b> </a> </td>
                </tr>
        <?php } ?>
        </table>
    </div>
</div>
