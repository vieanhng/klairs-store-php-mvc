<?php require_once ROOT . "/views/inc/header.php" ?>

<div class="breadcrumb">
    <div class="container">
        <h2><?=$data['title']?></h2>
    </div>
</div>
<div class="shop">
    <div class="container">
        <div class="checkout">
            <div class="container">
                <form action="<?=getUrl('checkout/placeorder')?>" method="post">
                <div class="row">
                    <div class="col-12 col-lg-8">
                            <div class="checkout__form">
                                <div class="checkout__form__shipping">
                                    <h5 class="checkout-title">Thông tin giao hàng</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Họ tên <span>*</span>
                                                    <input type="text" name="name" placeholder="Nhập họ tên">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Số điện thoại<span>*</span>
                                                    <input type="text" name="phone" placeholder="Nhập số điện thoại">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Địa chỉ <span>*</span>
                                                    <input type="text" name="address" placeholder="Nhập địa chỉ">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Ghi chú
                                                    <input type="text" name="note" placeholder="Ghi chú đơn hàng">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12 ml-auto">
                                <div class="checkout__total">
                                    <h5 class="checkout-title">Đơn hàng</h5>
                                    <div class="checkout__total__price">
                                        <h5>Sản phẩm</h5>
                                        <table>
                                            <colgroup>
                                                <col style="width: 70%">
                                                <col style="width: 30%">
                                            </colgroup>
                                            <tbody>
                                            <?php foreach ($data['cart']['detail'] as $item): ?>
                                            <tr>
                                                <td><span><?=$item->so_luong?> x </span><?=$item->ten_sp?>
                                                </td>
                                                <td><?=formatPrice($item->don_gia_ban)?></td>
                                            </tr>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <div class="checkout__total__price__total-count">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td>Giá trị giỏ hàng</td>
                                                    <td><?= formatPrice($data['cart']['cart']->thanh_tien)?></td>
                                                </tr>
                                                <tr>
                                                    <td>Vận chuyển</td>
                                                    <td><?= formatPrice(SHIPPING_COST)?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tổng đơn hàng</td>
                                                    <td><?= formatPrice($data['cart']['cart']->thanh_tien + SHIPPING_COST)?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="checkout__total__price__payment">
                                            <label class="checkbox-label" for="payment">
                                                <input id="payment" type="radio" name="payment">Thanh toán khi nhận hàng
                                            </label>
                                            <label class="checkbox-label" htformlfor="payment">
                                                <input id="payment" type="radio" name="payment">Thanh toán online
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn -dark">Thanh toán
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/inc/footer.php" ?>
