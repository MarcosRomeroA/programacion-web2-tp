<?php

require __DIR__."/../helpers/connection.php";
include "includes/header.php";
include "../helpers/dataHelper.php";
include "../helpers/functions.php";

// Array asociativo del JSON de categorias
// $categorias = getDataFromJSON('categorias');
$sql = "SELECT * FROM categories";

$categories = $con->query($sql);

if(!empty($_GET['del'])){
    $sql = "UPDATE categories SET deleted_at = NOW() WHERE category_id = ".$_GET['del'];
    $con->query($sql);
    redirect('categorias.php');
}

?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"
            style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
            <h6 class="m-0 font-weight-bold text-primary">Categorias</h6>
            <a class="btn btn-primary" href="categoria_add.php">+</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th style="width: 115px;">Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $categoria): ?>
                            <?php if($categoria['deleted_at'] == NULL): ?>
                                <tr>
                                    <td><?php echo $categoria['category_id'] ?></td>
                                    <td><?php echo $categoria['name'] ?></td>
                                    <td style="display: flex; justify-content: space-around; width: 115px;">
                                        <!-- boton de editar -->
                                        <a class="btn btn-info"
                                            href="categoria_add.php?id=<?php echo $categoria['category_id'] ?>"><i
                                                class="fas fa-edit"></i></a>
                                        <!-- boton de borrar -->
                                        <a class="btn btn-danger"
                                            href="categorias.php?del=<?php echo $categoria['category_id'] ?>"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include 'includes/footer.php';
?>