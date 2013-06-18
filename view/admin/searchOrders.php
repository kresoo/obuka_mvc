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
        <form action="includes/process_changes.php" method="GET">
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

    </div>
</div>