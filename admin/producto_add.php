<?php

include "includes/header.php";
include "../helpers/dataHelper.php";
include "../helpers/functions.php";

require __DIR__."/../helpers/connection.php";

// Array asociativo del JSON de productos
$productos = getDataFromJSON('productos');

$sqlCategories = "SELECT * FROM categories WHERE deleted_at IS NULL";

$sqlBrands = "SELECT * FROM brands WHERE deleted_at IS NULL";

$categories = $con->query($sqlCategories);

$brands = $con->query($sqlBrands);

// POST
if(isset($_POST['add'])){

    $name = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_POST['archivo'];
    

    if(!empty($_GET['id'])){

        $sql = "UPDATE products SET name = '$name', description = '$descripcion',
        category_id = '$categoria', brand_id = '$marca', price = '$precio',
        stock = '$stock', image = '$imagen' WHERE product_id = ".$_GET['id'];
        $con->query($sql);
    }
    else
    {
        $sql = "INSERT INTO products(name, description, category_id, brand_id, price, stock, image) 
        VALUES ('$name', '$descripcion', '$categoria', '$marca', '$precio', '$stock', '$imagen')";        
        $con->query($sql);
    }

    $archivo = $_FILES['archivo']['name'];

    if(isset($archivo) && $archivo != ""){
        $tipo = $_FILES["archivo"]['type'];

        $tamano = $_FILES['archivo']['size'];

        $temp = $_FILES['archivo']["tmp_name"];

        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000)))
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        else
            move_uploaded_file($temp, '../imagenes/'.$archivo);
    }

    redirect('productos.php');
}

if(!empty($_GET['id'])){
    // Array asociativo del JSON de productos
    $productos = getDataFromJSON('productos');
    // Informacion del producto del id enviado por GET
    $producto = $productos[$_GET['id']];
}


// Array de categorias
$categorias = getDataFromJSON('categorias');

// Array de marcas
$marcas = getDataFromJSON('marcas');

?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="w-auto" style="display: flex; flex-direction: row; align-items: center;">
                    <a class="btn btn-primary" href="productos.php"> <i class="fas fa-arrow-left"></i> </a>
                    <div class="text-primary" style="margin-left: 20px;">
                        Añadir Producto
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo !empty($producto['nombre']) ? $producto['nombre'] : ''?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descripcion</label>
                        <textarea class="form-control" name="descripcion" ><?php echo !empty($producto['descripcion'] ) ? $producto['descripcion'] : '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <?php foreach($categories as $categoria): ?>
                            <option value="<?php echo $categoria['category_id'] ?>">
                                <?php echo $categoria['name']  ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Marca</label>
                        <select name="marca" id="marca" class="form-control">
                            <?php foreach($brands as $marca): ?>
                                <option value="<?php echo $marca['brand_id'] ?>" >
                                    <?php echo $marca['name']  ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio</label>
                        <input type="text" class="form-control" name="precio" value="<?php echo !empty($producto) ? $producto['precio'] : ''?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Stock</label>
                        <input type="text" class="form-control" name="stock" value="<?php echo !empty($producto['stock']) ? $producto['stock'] : ''?>">
                    </div>

                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                        <div  style="display: flex; flex-direction: column;">
                            <label for="archivo">Subir Imagen</label>
                            <input name="archivo" type="file">
                        </div>

                        <div>
                            <?php if( !empty($producto['imagen']) ): ?>
                                <img src="../imagenes/<?php echo $producto['imagen'] ?>" width="150">
                            <?php endif; ?>
                        </div>

                    </div>

                    <button type="submit" name="add" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

    </div>

<?php include 'includes/footer.php'; ?>