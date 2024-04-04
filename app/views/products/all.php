<?php require_once ROOT . "/views/inc/header.php" ?>

    <div class="breadcrumb">
    <div class="container">
        <h2><?=$data['title']?></h2>
    </div>
</div>
    <div class="shop">
        <div class="container-full-half">
            <div class="shop-header">

                <select class="customed-select" name="#">
                    <option value="az">A to Z</option>
                    <option value="za">Z to A</option>
                    <option value="low-high">Low to High Price</option>
                    <option value="high-low">High to Low Price</option>
                </select>

            </div>
            <div class="shop-products">
                <div class="shop-products__gird" style="">
                    <div class="row mx-n1 mx-lg-n3">
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 px-1 px-lg-3">
                            <div class="product border p-3">
                                <div class="product-thumb"><a class="product-thumb__image" href="/shop/product-detail.html">
                                        <img src="<?=getUrl('public/assets/images/product/product2.jpg')?>" alt="Product image">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-content__header">
                                        <div class="product-category">eyes</div>
                                    </div><a class="product-name" href="/shop/product-detail.html">The expert mascaraa</a>
                                    <div class="product-content__footer">
                                        <h5 class="product-price--main">$35.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 px-1 px-lg-3">
                            <div class="product border p-3">
                                <div class="product-thumb"><a class="product-thumb__image" href="/shop/product-detail.html">
                                        <img src="<?=getUrl('public/assets/images/product/product2.jpg')?>" alt="Product image">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-content__header">
                                        <div class="product-category">eyes</div>
                                    </div><a class="product-name" href="/shop/product-detail.html">The expert mascaraa</a>
                                    <div class="product-content__footer">
                                        <h5 class="product-price--main">$35.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <ul class="paginator">
                <li class="page-item active">
                    <button class="page-link">1</button>
                </li>
                <li class="page-item">
                    <button class="page-link">2</button>
                </li>
                <li class="page-item">
                    <button class="page-link"><i class="far fa-angle-right"></i></button>
                </li>
            </ul>
        </div>
    </div>
<?php require_once ROOT . "/views/inc/footer.php" ?>