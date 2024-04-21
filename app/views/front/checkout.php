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
                <form id="checkout-form" action="<?=getUrl('checkout/placeorder')?>" method="post">
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
                                        <?php if($data['paymentMethods']):?>
                                        <div class="checkout__total__price__payment">
                                            <?php foreach ($data['paymentMethods'] as $payment):?>
                                            <label class="checkbox-label" for="payment-<?=$payment->ma_pttt?>">
                                                <input id="payment-<?=$payment->ma_pttt?>" type="radio" name="payment" <?=$payment->ma_pttt == 1 ? "checked": ""?> value="<?=$payment->ma_pttt?>"><?=$payment->ten_pttt?>
                                            </label>
                                             <?php endforeach;?>
                                        </div>
                                        <?php endif;?>
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
<script>
    $(document).ready(function () {
        $('#checkout-form').validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true
                },
                address: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Vui lòng nhập họ tên"
                },
                phone: {
                    required: "Vui lòng nhập số điện thoại"
                },
                address: {
                    required: "Vui lòng nhập địa chỉ"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>