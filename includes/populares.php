<?php

include('config/db.php');
?> 
    <?php include('helpers/connection.php')?>

<!--? Popular Items Start -->
<div class="popular-items section-padding30">
    <div class="container">
        <!-- Section tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-70 text-center">
                    <h2>Clasicos</h2>
                    <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Quis ipsum suspendisse ultrices gravida.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="display: flex; align-items:baseline">
                

                <?php 
                
                $datos=file_get_contents('db/productos.json');
                $datos_json=json_decode($datos,true);

                foreach($datos_json as $prod){
                
                    // $sql = "INSERT INTO products(product_id, category_id, brand_id, name, description, price, stock, image) VALUES 
                    // (".$prod['id'].",".$prod['id_categoria'].",".$prod['id_marca'].",'".$prod['nombre']."','".$prod['descripcion']."','".$prod['precio']."','".$prod['stock']."','".$prod['imagen']."')";
                    $sql = "SELECT * FROM products";
                    $con->query($sql);
                ?>
                    <div class="single-popular-items mb-50 text-center col-md-3" >
                        <div class="popular-img">
                            <img src="imagenes/<?php echo $prod['imagen']?>" alt="iteracion de relojes">
                            <div class="img-cap">
                                <span>Añadir al carrito</span>
                            </div>
                            <div class="favorit-items">
                                <span class="flaticon-heart"></span>
                            </div>
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.php?prodId=<?php echo $prod['id']?>"><?php echo $prod['nombre']?></a></h3>
                            <span>$ <?php echo $prod['precio'] ?></span>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- Button -->
        <div class="row justify-content-center">
            <div class="room-btn pt-70">
                <a href="shop.php" class="btn view-btn1">Ver mas relojes</a>
            </div>
        </div>
    </div>
</div>
<!-- Popular Items End -->