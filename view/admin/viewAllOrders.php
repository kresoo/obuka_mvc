<div class="row" style="background:#eeeeee;padding:20px;">
        <?php echo "<h3> All orders </h3> <hr />";?>
        <table class="table table-bordered" id="search">
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