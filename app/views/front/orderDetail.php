<?php require_once ROOT . "/views/inc/header.php" ?>

<div class="breadcrumb" style="margin-bottom: 61px;height: 145px;">
    <div class="container">
        <h2><?=$data['title']?></h2>
        <ul>
            <li>Trạng thái: <strong><em><?=$data['order']->trang_thai?></em></strong></li>
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
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">Sản phẩm 1</td>
                                <td style="text-align: center;">1000đ</td>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">1000đ</td>
                            </tr>
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
                                <td class="text-end">1000đ</td>
                            </tr>
                            <tr>
                                <td class="text-end">Vận chuyển:</td>
                                <td class="text-end">50,000đ</td>
                            </tr>
                            <tr>
                                <td class="text-end">Tổng đơn hàng:</td>
                                <td class="text-end">51,000đ</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <p><strong>Thông tin giao hàng</strong></p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Họ tên:</td>
                                <td>Nguyễn Việt Anh</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td>0379922906</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ nhận hàng:</td>
                                <td>Khách sạn Hilton Hanoi Opera</span></td>
                            </tr>
                            <tr>
                                <td>Note:</td>
                                <td></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>Phương thức thanh toán: <strong>Thanh toán khi nhận hàng</strong></td>
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

