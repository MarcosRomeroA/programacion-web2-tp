<?php

include "includes/header.php";
include "../helpers/dataHelper.php";
include "../helpers/functions.php";

// Array asociativo del JSON de categorias
// $comentarios = getDataFromJSON('comentarios');
// $productos = getDataFromJSON('productos');
require __DIR__."/../helpers/connection.php";
// Array asociativo del JSON de marcas
$sql = "SELECT * FROM comments";

$comments = $con->query($sql);

if(!empty($_GET['del'])){
    $sql = "UPDATE comments SET deleted_at = NOW() WHERE brand_id = ".$_GET['del'];
    $con->query($sql);
    // unset($comentarios[$_GET['del']]);
    // setDataJSON('comentarios', $comentarios);
}
?>
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary">Comentarios</h6>
                <form class="d-flex flex-row" action="" method="get">
                    <select class="form-control mr-3" name="id_producto">
                        <option value="0">
                            Ver todos
                        </option>
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?php echo $producto['id'] ?>" <?php echo isset($_GET['id_producto']) && $_GET['id_producto'] == $producto['id'] ? 'selected' : '' ?>  >
                                <?php echo $producto['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class = "btn btn-primary">
                        Buscar
                    </button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th style="width: 115px;">Producto</th>
                            <th>Comentario</th>
                            <th>Borrar</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($comments as $comentario): ?>
                                <?php if($comentario['is_visible'] == NULL): ?>
                                    <?php if( (isset($_GET['id_producto']) && ($comentario['id_producto'] == $_GET['id_producto'] || $_GET['id_producto'] == 0)) || !isset($_GET['id_producto']) ):  ?>
                                        <tr>
                                            <td><?php echo $comentario['comment_id'] ?></td>
                                            <td><?php echo $comentario['user_id'] ?></td>
                                            <td><?php echo $productos[$comentario['product_id']]['user_id'] ?></td>
                                            <td><?php echo $comentario['description'] ?></td>
                                            <td><a class="btn btn-danger" href="comentarios.php?del=<?php echo $comentario['comment_id'] ?>"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php endif; ?>
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