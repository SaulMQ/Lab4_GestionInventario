<?php
    include_once 'public/header.php';
?>

<table>
    <tr>
        <th>ID</th>
        <th>Item</th>
    </tr>
    
    <?php
       //  print_r($vars['listado']); // imprimir array
        foreach($vars['listado'] as $item){
    ?>
    <tr>
        <td><?php echo $item[0]; ?></td>
        <td><?php echo $item[1]; ?></td>
    </tr>
    
    <?php 
        }
    ?>
</table>

<?php
    include_once 'public/footer.php';
?>