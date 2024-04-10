<?php require_once ROOT . "/views/inc/header.php" ?>

<?php $order = $data['order']?>
<div class="breadcrumb" style="margin-bottom: 61px;height: 145px;">
    <div class="container">
        <h2><?=$data['title']?></h2>
        <ul>
            <li>Trạng thái: <strong><em><?=$order['summary']->trang_thai?></em></strong></li>
        </ul>
    </div>
</div>

<div class="contact">
    <div class="container">
        <div class="row d-xxl-flex justify-content-center justify-content-xxl-center">
            <div class="col-12 col-md-11 col-lg-11 col-xxl-11">
                <div class="contact-form">
                    <p><strong>Danh sách sản phẩm</strong></p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="text-align: center;">No.</th>
                                <th style="text-align: center;">Tên sản phẩm</th>
                                <th style="text-align: center;">Đơn giá</th>
                                <th style="text-align: center;">Số lượng</th>
                                <th style="text-align: center;">Tổng tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($order['detail'] as $index=>$item):?>
                            <tr>
                                <td style="text-align: center;"><?=$index+1?></td>
                                <td style="text-align: center;"><?=$item->ten_sp?></td>
                                <td style="text-align: center;"><?=formatPrice($item->don_gia_ban)?></td>
                                <td style="text-align: center;"><?=$item->so_luong?></td>
                                <td style="text-align: center;"><?=formatPrice($item->tong_tien)?></td>
                            </tr>

                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-11 col-lg-11 col-xxl-11">
                <div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td class="text-end">Tổng giỏ hàng:</td>
                                <td class="text-end"><?=formatPrice($order['summary']->thanh_tien - SHIPPING_COST)?></td>
                            </tr>
                            <tr>
                                <td class="text-end">Vận chuyển:</td>
                                <td class="text-end"><?=formatPrice(SHIPPING_COST)?></td>
                            </tr>
                            <tr>
                                <td class="text-end">Tổng đơn hàng:</td>
                                <td class="text-end"><?=formatPrice($order['summary']->thanh_tien)?></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <p><strong>Thông tin giao hàng</strong></p>
                    <?php $ttgh = json_decode($order['summary']->thong_tin_nhan_hang)?>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Họ tên:</td>
                                <td><?= $ttgh->ho_ten?></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td><?= $ttgh->dien_thoai?></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ nhận hàng:</td>
                                <td><?= $ttgh->dia_chi?></td>
                            </tr>
                            <tr>
                                <td>Note:</td>
                                <td><?=$order['summary']->note?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>Phương thức thanh toán: <strong><?=$order['summary']->ten_pttt?></strong></td>
                                <td class="text-end"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once ROOT . "/views/inc/footer.php" ?>

