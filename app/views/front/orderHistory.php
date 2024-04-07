<?php require_once ROOT . "/views/inc/header.php" ?>
<div class="breadcrumb">
    <div class="container">
        <h2><?=$data['title']?></h2>
    </div>
</div>

<div class="shop">
    <div class="container">
        <div class="row d-xxl-flex justify-content-center justify-content-xxl-center">
            <div class="col-12 col-md-11 col-lg-11 col-xxl-11">
                <div class="contact-form">
                    <div class="table-responsive" style="color: black">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="text-align: center;">No.</th>
                                <th style="text-align: center;">Mã Đơn Hàng</th>
                                <th style="text-align: center;">Ngày đặt</th>
                                <th style="text-align: center;">Thành tiền</th>
                                <th style="text-align: center;">Trạng thái</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data['orderList'] as $index => $order): ?>
                            <tr>
                                <td style="text-align: center;"><?=$index +1?></td>
                                <td style="text-align: center;"><?=$order->ma_dh?></td>
                                <td style="text-align: center;"><?=$order->ngay_lap_dh?></td>
                                <td style="text-align: center;"><?=$order->thanh_tien?></td>
                                <td style="text-align: center;"><?=$order->trang_thai?></td>
                                <td style="text-align: center;"><a href="<?=getUrl('users/orderHistory/orderId/'.$order->ma_dh)?>">Chi tiết</a></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once ROOT . "/views/inc/footer.php" ?>
