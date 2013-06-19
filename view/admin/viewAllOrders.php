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
        <?php echo "All orders <br /> <hr />";?>
        <table id="search">
    <tr>
        <th> Order ID </th>
        <th> Ordered products </th>
        <th> Quantity </th>
        <th> Price of each product </th>
        <th> Total price </th>
        <th> Customer info </th>
        <th> Shipping address </th>
        <th> Payment method </th>
    </tr>
    <?php foreach ($allOrders as $order):?>
        <tr> 
            <td> <?php echo $order->id ?></td>
            <td> 
                <?php
                    foreach ($order->items as $item ){
                        echo $item->name ."<br />";
                    }
                ?> 
            </td>
            <td> 
                <?php
                    foreach ($order->items as $item ){
                        echo $item->qty ."<br />";
                    }
                ?> 
            </td>
            <td> 
                <?php
                    foreach ($order->items as $item ){
                        echo $item->price ."$<br />";
                    }
                ?> 
            </td>
            <td> <?php echo $order->total_price . "$" ?></td>
            <td> 
                <?php
                    foreach ($order->customer_info as $item ){
                        echo $item ."<br />";
                    }
                ?> 
            </td>
            <td> <?php echo $order->shipping_info; ?> </td>
           <td> <?php echo $order->payment_info; ?> </td>
        </tr>
    <?php endforeach; ?>
</table>

    </div>
</div>