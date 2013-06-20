
        <form action="searchOrders" method="GET">
            Search orders  <br /> <hr />
            <div id="search_string" style="height:50px;"> </div>
            <div id="search_input" style="height:50px;">
                <input type="text" name="search_field"  /> <br /><br />
            </div>
            <div id="price_range" style="height:50px;">
                <input class="price" type="text" name="price_from" size="5" />$ -
                <input class="price" type="text" name="price_to" size="5" />$
            </div> <br />
            Search by: <br /> <br />
            <table id="search_criteria">
                <tr> 
                    <td> Order ID </td> 
                    <td> User ID </td> 
                    <td> Payment method </td> 
                    <td> Price </td>
                    <td> Customer name </td>
                    <td> Customer email address </td>
                </tr>
                <tr>
                    <td> <input class="searchRadio" search_string="Order ID:" type="radio" name="search_by" value="id" checked="checked"/> </td>
                    <td> <input class="searchRadio" search_string="User ID:" type="radio" name="search_by" value="user_id" /> </td>
                    <td> <input class="searchRadio" search_string="Payment method:" type="radio" name="search_by" value="payment_info" /> </td>
                    <td> <input class="searchRadio" id="price" search_string="Price range:" type="radio" name="search_by" value="total_price" /> </td>
                    <td> <input class="searchRadio" search_string="Customer name:" type="radio" name="search_by" value="customer_name" /> </td>
                    <td> <input class="searchRadio" search_string="Customer email address:" type="radio" name="search_by" value="customer_email" /> </td>
                </tr>
            </table>
            <br />
            <input type="submit" name="search" value="Search" /> <br />
        </form>
        <div>
           <?php if(!empty($result)):?>
           <table id="search">
            <tr>
                <th> Order ID </th>
                <th> Ordered products </th>
                <th> Quantity </th>
                <th> Price of each product </th>
                <th> Total price </th>
                <th> Shipping address </th>
                <th> Payment method </th>
            </tr>
            <?php foreach ($result as $order): ?>
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
                    <td> <?php echo $order->shipping_info; ?> </td>
                   <td> <?php echo $order->payment_info; ?> </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
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
 