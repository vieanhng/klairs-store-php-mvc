<?php require_once ROOT . "/views/inc/header.php" ?>
<div class="breadcrumb">
    <div class="container">
        <h2><?=$data['title']?></h2>
    </div>
</div>
<div class="contact">
    <div class="container">
        <div class="row d-xxl-flex justify-content-center justify-content-xxl-center">
            <div class="col-12 col-md-6 col-xl-9 col-xxl-10">
                <div style="text-align: center;font-size: 34px;"><span class="fs-1" style="color: rgb(33, 37, 41);">Cảm ơn bạn đã lựa chọn Klairs</span></div>
                <div style="text-align: center;margin-top: 12px;"><span style="color: rgb(33, 37, 41);">Mã đơn hàng của bạn là #<?=$_GET['orderCode']?></span></div>
                <div style="text-align: center;margin-top: 21px;">
                    <a href="<?=getUrl('users/orderHistory/orderId/'.$_GET['orderCode'])?>">
                    <button class="btn btn-primary -dark" type="button" style="transform: scale(0.77);">Xem thông tin đơn hàng</button>
                    </a>
                </div>
                <div style="text-align: center;margin-top: 26px;"><a href="<?=getUrl('')?>">Tiếp tục mua hàng</a></div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/inc/footer.php" ?>
