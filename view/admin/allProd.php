
        <table class="table table-striped">
            <?php foreach ($allProducts as $product) {
                ?>
                <tr>
                    <td> <?php echo $product->name; ?> </td> 
                    <td> <a class="btn btn-info" href="/admin/changeProdProp/id/<?php echo $product->id ?>"  > <b> Change name </b> </a> </td>
                </tr>
        <?php } ?>
        </table>
