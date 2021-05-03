
<?php $new_arrivals = [
    1 => ['nombre' => 'Thermo Ball Etip Gloves', 'precio' => '45.600', 'imagen' => 'new_product1.png'],
    2 => ['nombre' => 'Thermo Ball Etip Gloves', 'precio' => '60.000', 'imagen' => 'new_product2.png'],
    3 => ['nombre' => 'Thermo Ball Etip Gloves', 'precio' => '70.600', 'imagen' => 'new_product3.png']
];
?>

<!-- ? New Product Start -->
<section class="new-product-area pt-70">
    <div class="container">
        <!-- Section tittle -->
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle mb-70">
                    <h2>Ejecutivos</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($new_arrivals as $new_arrival){ ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-new-pro mb-30 text-center">
                    <div class="product-img">
                        <img src="assets/img/gallery/<?php echo $new_arrival['imagen']?>" alt="">
                    </div>
                    <div class="product-caption">
                        <h3><a href="#"></a><?php echo $new_arrival['nombre'] ?></h3>
                        <!--"product_details.php?prodId=">   -->
                        <?php# echo $new_arrival['nombre']?>
                        <span><?php echo $new_arrival['precio']?></span>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>
<!--  New Product End -->