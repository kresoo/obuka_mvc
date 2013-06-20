    <div class="hero-unit" style="color:#ABABAB">
        <img class="pull-left" src="/images/admin.svg" style="width:100px;height: 100px;margin-right: 60px;"/>
        <h1 > Web Store <span style="color:#2CB7F2"> </small> Admin </span>  area  </h1>
    </div> 
    <div style="margin:0 auto;width:200px;color:#ABABAB;">
        <h2> <span style="color:#2CB7F2;"> Log in: </span> </h3> <hr />
        <form  action="login" method="POST">
            <h3>Username:</h3>
            <input  type="text" name="username" /> <br /> <br />
            <h3>Password:</h3> 
            <input type="password" name="password" /> <br /> <br />
            <input class="btn btn-primary btn-large" type="submit" name="login" value="Log in" />
        </form>
    </div>
    <div style="text-align: center;margin-top: 10px;color:#E84848">
        <?php 
            if(!empty($_SESSION['message'])){
                echo  $_SESSION['message']; 
                unset($_SESSION['message']);
            } 
        ?>
    </div>
