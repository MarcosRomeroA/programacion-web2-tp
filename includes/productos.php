<?php

include_once "helpers/dataHelper.php";

$categorias = getDataFromJSON('categorias');

$productos = getDataFromJSON('productos');

$marcas = getDataFromJSON('marcas');

?>

<?php

include('config/db.php');
?> 

<?php include('helpers/connection.php')?>
        
<!-- Latest Products Start -->
<section id="productos" class="popular-items latest-padding" style="padding-top: 50px!important;">
    <div class="container">
        <div class="row product-btn justify-content-between mb-40">
            <div class="properties__button w-100" >
                <!--Nav Button  -->
                <nav style="display: flex; justify-content: space-around">
                    <div>
                        <h3>Categorias</h3>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link <?php if(empty($_GET['categoria'])) echo "active"; ?>"  href="shop.php?#productos">Todos</a>

                            <?php foreach($categorias as $categoria): ?>
                                <a class="nav-item nav-link <?php if(!empty($_GET['categoria']) && $_GET['categoria'] == $categoria['id']) echo "active"; ?>"
                                   href="shop.php?categoria=<?php echo $categoria['id'] ?><?php echo !empty($_GET['marca']) ? "&marca=".$_GET['marca'] : '' ?>#productos"
                                >
                                    <?php echo $categoria['nombre'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div>
                        <h3>Marcas</h3>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link <?php if(empty($_GET['marca'])) echo "active"; ?>"  href="shop.php?#productos">Todos</a>

                            <?php foreach($marcas as $marca): ?>
                                <a class="nav-item nav-link <?php if(!empty($_GET['marca']) && $_GET['marca'] == $marca['id']) echo "active"; ?>"
                                   href="shop.php?<?php echo !empty($_GET['categoria']) ? 'categoria='.$_GET['categoria'].'&' : '' ?>marca=<?php echo $marca['id'] ?>#productos"
                                >
                                    <?php echo $marca['nombre'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </nav>
                <!--End Nav Button  -->
            </div>
        </div>
        <!-- Nav Card -->
        <div class="tab-content" id="nav-tabContent">
            <!-- card one -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">

                    <?php foreach($productos as $producto){?>

                        <?php if(
                                ( isset($_GET['categoria']) && $producto['id_categoria'] == $_GET['categoria'] ) &&
                                ( isset($_GET['marca']) && $producto['id_marca'] == $_GET['marca'] )
                            ):
                        ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto['imagen'] ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto['id']?>"><?php echo $producto['nombre'] ?></a></h3>
                                        <span>$ <?php echo number_format($producto['precio'], 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( (isset($_GET['categoria']) && $producto['id_categoria'] == $_GET['categoria']) && !isset($_GET['marca'])    ): ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto['imagen'] ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto['id']?>"><?php echo $producto['nombre'] ?></a></h3>
                                        <span>$ <?php echo number_format($producto['precio'], 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( (isset($_GET['marca']) && $producto['id_marca'] == $_GET['marca']) && !isset($_GET['categoria'])   ): ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto['imagen'] ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto['id']?>"><?php echo $producto['nombre'] ?></a></h3>
                                        <span>$ <?php echo number_format($producto['precio'], 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( !isset($_GET['marca']) && !isset($_GET['categoria'])): ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto['imagen'] ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto['id']?>"><?php echo $producto['nombre'] ?></a></h3>
                                        <span>$ <?php echo number_format($producto['precio'], 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End Nav Card -->
    </div>
</section>