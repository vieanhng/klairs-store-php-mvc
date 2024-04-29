<?php require_once ROOT . "/views/inc/header.php" ?>
<?php

// let's paginate data from an array...
$products = $data['products'];
if($products){
    $records_per_page = 12;
    $pagination = new Zebra_Pagination();
    $pagination->records(count($products));
    $pagination->records_per_page($records_per_page);
    $products = array_slice(
        $products,
        (($pagination->get_page() - 1) * $records_per_page),
        $records_per_page
    );
}


?>

    <div class="breadcrumb">
    <div class="container">
        <h2><?=$data['title']?></h2>
    </div>
</div>
    <div class="shop">
        <div class="container-full-half">
            <?php if($products):?>
            <div class="shop-products">

                <div class="shop-products__gird" style="">
                    <div class="row mx-n1 mx-lg-n3">
                        <?php foreach ($products as $product):?>
                        <?php $productUrl = getUrl('products/detail/id/'.$product->ma_sp)?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 px-1 px-lg-3">
                            <div class="product border p-3">
                                <div class="product-thumb"><a class="product-thumb__image" href="<?=$productUrl?>">
                                        <img src="<?=getUrl('public/uploads/product/'.$product->anh_sp)?>" alt="Product image">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-content__header">
                                    </div><a class="product-name" href="<?=$productUrl?>"><?= $product->ten_sp?></a>
                                    <div class="product-content__footer">
                                        <h5 class="product-price--main"><?= formatPrice($product->don_gia_ban)?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach;?>
                    </div>
                </div>


            </div>
            <?php endif;?>
            <?php
if($products){
    $pagination->render();
}
            // render the pagination links


            ?>
        </div>
    </div>
<?php require_once ROOT . "/views/inc/footer.php" ?>