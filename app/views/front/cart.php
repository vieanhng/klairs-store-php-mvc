<?php require_once ROOT . "/views/inc/header.php" ?>

<?php
$cart = isset($data['cart']['cart']) ? $data['cart']['cart'] : false;
$detail = isset($data['cart']['detail']) ? $data['cart']['detail'] : false;
?>
    <div class="breadcrumb">
        <div class="container">
            <h2>Giỏ hàng</h2>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="cart">

                <div class="container">
                    <?php if($cart && $detail):?>
                    <div class="row">
                        <div class="col-12 col-md-8">

                            <div class="cart__table cart__detail">
                                <div class="cart__table__wrapper">
                                    <form id="cartForm">
                                        <input type="hidden" name="cartId" value="<?= $cart->ma_gio_hang ?>">
                                    <table>
                                        <colgroup>
                                            <col style="width: 10%"/>
                                            <col style="width: 10%"/>
                                            <col style="width: 17%"/>
                                            <col style="width: 17%"/>
                                            <col style="width: 17%"/>
                                            <col style="width: 9%"/>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Sản phẩm</th>
                                            <th>Giá tiền</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($detail) > 0):?>
                                        <?php foreach ($detail as $item):?>
                                        <tr>
                                            <td>
                                                <img src="<?=getUrl('public/assets/images/product/'.$item->image)?>" alt="" height="70px">
                                            </td>
                                            <td>
                                                <div class="cart-product">
                                                    <div class="cart-product__content">
                                                        <a href="product-detail.html">
                                                            <?= $item->ten_sp?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?=formatPrice($item->don_gia_ban)?></td>
                                            <td>
                                                <div class="quantity-controller ">
                                                    <div class="input-validator">
                                                    <input type="number" class="pd-qty" min="1" name="qty_<?=$item->ma_sp?>" value="<?= $item->so_luong?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= formatPrice($item->tong_tien
                                                )?></td>
                                            <td><a href="<?=getUrl('carts/deleteItem/id/'.$item->ma_sp)?>"><i class="fal fa-times"></i></a></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                                <div class="cart__table__footer">
                                    <a href="<?=URL?>" class="btn">
                                        <i class="fal fa-long-arrow-left">
                                        </i>Tiếp tục mua sắm</a>
                                    <a href="#" class="btn" type="button" id="updateCart">
                                        Cập nhật

                                    </a>

                                    <a href="<?=getUrl('carts/clear')?>" class="btn" id="deleteCart">
                                            <i class="fal fa-trash">

                                            </i>Xoá giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="cart__total__content">
                                <h3>Giỏ hàng</h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <th>Tổng giá tiền </th>
                                        <td><?=formatPrice($cart->thanh_tien)?></td>
                                    </tr>
                                    <tr>
                                        <th>Vận chuyển</th>
                                        <td><?=formatPrice(SHIPPING_COST)?></td>
                                    </tr>
                                    <tr>
                                        <th>Thành tiền</th>
                                        <td class="final-price"><?=formatPrice($cart->thanh_tien + SHIPPING_COST) ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a class="btn -dark" href="<?= getUrl('checkout')?>">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="row" style="text-align: center">
                    <p>Giỏ hàng trống.</p>
                        <p class="mt-4"><a href="<?=getUrl('')?>">Quay về trang chủ</a></p>
                    </div>
                    <?php endif;?>
                </div>

            </div>
        </div>
    </div>
<?php require_once ROOT . "/views/inc/footer.php" ?>

<script>
    $(document).ready(function (){
        <?php Session::success('successUpdateCart')?>
        <?php Session::danger('errorUpdateCart')?>
        <?php Session::success('successAddToCart')?>
        <?php Session::danger('addToCartFail')?>
        <?php Session::success('successDeleteItem')?>
        $('#updateCart').on('click',function () {

            const formData = $('#cartForm').serializeArray();
            let formattedData = {cartId:null,items:[]};
            formData.forEach(item => {
                if (item.name === 'cartId') {
                    formattedData.cartId = parseInt(item.value); // Parse the value to integer
                }
                else if (item.name.startsWith('qty_')) {
                    let fields = item.name.split('_');

                    formattedData.items.push({ id: fields[1], qty: item.value });
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?=getUrl('carts/updateCart')?>',
                data: formattedData
            }).done(function (data, textStatus, jqXHR) {
                location.reload();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                location.reload();
            });
        })
    })
</script>

