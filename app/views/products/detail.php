<?php require_once ROOT . "/views/inc/header.php" ?>
<?php
$product = $data['product'];
?>
    <div class="breadcrumb">
    <div class="container">
        <h2><?=$data['title']?></h2>
    </div>
</div>
    <div class="shop">
        <div class="container">
            <div class="product-detail__wrapper">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="product-detail__slide-two">
                            <div class="slider__item"><img src="<?=getUrl('public/assets/images/product/product2.jpg')?>" alt="Product image"/></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="product-detail__content">
                            <div class="product-detail__content">
                                <div class="product-detail__content__header">
                                    <h2 class="product-price--main"><?=$product->ten_sp?></h2>
                                </div>

                                <table>
                                    <tr>
                                        <td><h5 class="product-price--main">310.000đ</h5></td>
                                    </tr>
                                </table>
                                <div class="divider"></div>

                                    <div   >Khả dụng: <?= $product->so_luong?></div>
                                <div class="product-detail__content__footer">
                                    <ul>
                                        <li><?=$product->mo_ta?></li>
                                    </ul>
                                    <form id="addToCart-<?=$product->ma_sp?>" method="post" action="<?=getUrl('carts/add')?>">
                                        <input type="hidden" name="productId" value="<?=$product->ma_sp?>">
                                    <div class="product-detail__controller">

                                        <div class="quantity-controller -border -round">
                                            <div class="quantity-controller__btn -descrease">-</div>
                                            <div id="qty" class="quantity-controller__number">1</div>
                                            <div class="quantity-controller__btn -increase">+</div>
                                            <input type="hidden" id="product-qty" name="qty" value="1">
                                        </div>
                                        <div class="add-to-cart -dark" id="addtocart-<?=$product->ma_sp?>-button">
                                            <h5>Thêm vào giỏ hàng</h5>
                                        </div>
                                        <div class="product-detail__controler__actions"></div>

                                    </div>
                                    </form>
                                    <div class="divider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once ROOT . "/views/inc/footer.php" ?>

<script>
    $(document).ready(function() {
        <?php Session::danger('addToCartFail')?>
        $('.quantity-controller__btn').on('click',function () {
            let qty = $('#qty').text();
            if($(this).hasClass('-descrease')){
                if(qty > 1){
                    qty--
                    $('#qty').text(qty);
                    $('#product-qty').val(qty);
                }
            }
            if($(this).hasClass('-increase')){
                qty++
                $('#qty').text(qty)
                $('#product-qty').val(qty)
            }
        })

        $('#addtocart-<?=$product->ma_sp?>-button').on('click',function () {
            $('#addToCart-<?=$product->ma_sp?>').submit();
        })


    });
</script>
