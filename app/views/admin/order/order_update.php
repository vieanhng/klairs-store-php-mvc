<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<?php
$orderSummary = $data['order']['summary'];
$orderDetail = $data['order']['detail'];
$customerDetail = $data['order']['customer'];
?>
<div class="container-fluid">
    <form method="post">
        <div class="row mb-3">
            <div class="col-lg-7 col-xl-8">
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Sản phẩm</p>
                        </div>
                        <div class="table-responsive" style="border: 0.5px solid rgb(227,227,227);">
                            <table class="table table-borderless">
                                <thead class="table-light" style="border-bottom-width: 0.5px;border-bottom-color: rgb(223, 224, 227);">
                                <tr>
                                    <th>#</th>
                                    <th>MSP</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orderDetail as $index=>$item):?>
                                <tr>
                                    <td><?=$index + 1?></td>
                                    <td><?=$item->ma_sp?></td>
                                    <td><?=$item->ten_sp?></td>
                                    <td><?=formatPrice($item->don_gia_ban)?></td>
                                    <td><?=$item->so_luong?></td>
                                    <td><?=formatPrice($item->tong_tien)?></td>

                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label" for="username"><strong>Khách hàng đặt hàng</strong></label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Họ tên</strong></label>
                                        <input id="ma_dh-4" class="form-control" type="text" value="<?= $customerDetail->ten_kh?>" readonly />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Email</strong></label>
                                        <input id="ma_dh-5" class="form-control" type="text" value="<?= $customerDetail->email?>" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Thông tin nhận hàng</p>
                        </div>
                        <?php $ttgh = json_decode($orderSummary->thong_tin_nhan_hang)?>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3"><label class="form-label" for="username"><strong>Tên người nhận</strong></label>
                                    <input id="ma_dh-1" class="form-control" type="text" readonly value="<?=$ttgh->ho_ten?>" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3"><label class="form-label" for="username"><strong>Số điện thoại</strong></label>
                                    <input id="ma_dh-2" class="form-control" type="text" readonly value="<?=$ttgh->dien_thoai?>" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label" for="username"><strong>Địa chỉ giao hàng</strong></label>
                            <input id="ma_dh-3" class="form-control" type="text" readonly value="<?=$ttgh->dia_chi?>" />
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Phương thức thanh toán</p>
                        </div>
                        <div class="d-inline-flex w-100">
                            <div class="form-check" style="width: 50%;">
                                <span class="form-check-label"><?=$orderSummary->ten_pttt?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">

                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label" for="username"><strong>Trạng thái đơn hàng</strong></label>
                            <select class="form-select" name="status">
                                <optgroup label="Trạng thái đơn hàng">
                                    <?php foreach (OrderStatus::orderStatus() as $item):?>
                                    <option <?= $item === $orderSummary->trang_thai ? "selected" : "" ?>  value="<?= $item ?>"><?=$item?></option>
                                    <?php endforeach;?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="table-responsive text-start" style="border-bottom: 0.5px solid rgb(224,224,224);">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>Tổng tiền hàng:</td>
                                    <td class="text-end"><?= formatPrice($orderSummary->tien_hang) ?></td>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển:</td>
                                    <td class="text-end"><?=formatPrice($orderSummary->thanh_tien - $orderSummary->tien_hang)?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>Tổng tiền phải trả:</td>
                                    <td class="text-end"><?= formatPrice($orderSummary->thanh_tien) ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;background: rgba(255,255,255,0);">
                    <div class="card-body d-inline-flex justify-content-between" style="background: rgba(255,255,255,0);padding-left: 0px;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;margin-bottom: 9px;">
                        <button class="btn btn-primary w-100" type="submit" style="margin-right: 5px;">Lưu</button>
                    </div>
                    <div class="card-body d-inline-flex justify-content-between" style="background: rgba(255,255,255,0);padding-left: 0px;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;margin-bottom: -1px;">
                        <button class="btn btn-secondary w-50" type="button" style="margin-right: 5px;">Huỷ</button>
                        <button data-bs-target="#modal-1" data-bs-toggle="modal" data-orderid="<?=$orderSummary->ma_dh?>" class="btn btn-danger w-50" type="button" style="margin-left: 5px;">Xoá</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="modal-1" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body text-dark" style="height: 171px;">
                <p class="fs-3 text-center" style="margin-top: 32px;"><strong>Xoá đơn hàng</strong></p>
                <p class="text-center" style="margin-top: 24px;">Bạn có chắc chắn muốn xóa đơn hàng này?</p>
            </div>
            <div class="modal-footer d-inline-flex d-xxl-flex justify-content-around" style="border-style: none;height: 107px;">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal" style="margin-left: 1px;margin-right: 0px;padding-left: 40px;padding-right: 40px;padding-bottom: 10px;padding-top: 10px;">Huỷ bỏ</button>
                <a onclick="deleteOrder(orderId)">
                    <button class="btn btn-secondary" type="button"
                            style="margin-left: 1px;margin-right: 0px;padding-left: 40px;padding-right: 40px;padding-bottom: 10px;padding-top: 10px;">
                        Đồng ý
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>
<script>
    $(document).ready(function () {
        <?php Session::danger('updateStatusOrderFail')?>
        <?php Session::success('updateStatusOrderSuccess')?>
    })
    $('#modal-1').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        orderId = button.data('orderid');
    });

    function deleteOrder(orderId) {
        window.location.href = "<?=getUrl('admin/orders/delete/id/')?>" + orderId;
    }

</script>