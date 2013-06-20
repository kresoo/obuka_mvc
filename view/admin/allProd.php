
        <table class="display">
            <?php foreach ($allProducts as $product) {
                ?>
                <tr>
                    <td> <?php echo $product->name; ?> </td> 
                    <td> <a href="/admin/changeProdProp/id/<?php echo $product->id ?>"  > <b> Change name </b> </a> </td>
                </tr>
        <?php } ?>
        </table>
