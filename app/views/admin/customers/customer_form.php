<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<?php
isset($data['customer']) ? $customer = $data['customer'] : $customer = false;

if ($customer){
    $orders = $data['orders'];
    $count = $data['orders'] ? count($data['orders']) : 0;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($orders){
        $records_per_page = 10;
        $pagination = new Zebra_Pagination();
        $pagination->records(count($orders));
        $pagination->records_per_page($records_per_page);
        $orders = array_slice(
            $orders,
            (($pagination->get_page() - 1) * $records_per_page),
            $records_per_page
        );
    }
}
?>

<div class="container-fluid">
    <div class="card border-0 rounded-0" style="margin-top: 0px;">
        <div class="card-body">
            <form id="customerForm" class="text-dark" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><input class="form-control" type="hidden"
                                        <?=$customer ? "value={$customer->ma_kh}" : "name=ma_kh" ?> ></div>
                        <div class="mb-3"><label class="form-label" for="ten_kh"><strong>Tên khách hàng</strong></label>
                                <input class="form-control" type="text" placeholder="Nhập tên khách hàng"
                                    name="ten_kh" value = "<?= $customer ? $customer->ten_kh : ""?>" ></div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="email"><strong>Email</strong></label>
                                <input class="form-control" type="text" placeholder="Nhập email khách hàng"
                                    name="email" value = "<?= $customer ? $customer->email : ""?>" ></div>
                    </div>
                
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="sdt"><strong>Số điện thoại</strong></label>
                                <input class="form-control" type="text" placeholder="Nhập số điện thoại khách hàng"
                                    name="sdt" value = "<?= $customer ? $customer->dien_thoai : ""?>" ></div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <!-- Reset mk -->
                    <?php if($customer){?>
                    <button id="reset-password" class="btn btn-warning ml-3" type="button" style="margin-right: 20px; padding-right: 20px;padding-left: 20px;">
                        Reset mật khẩu
                    </button>
                    <?php }?>
                    <a href="<?=getUrl('admin/customers')?>"><button class="btn btn-secondary" type="button"
                            style="margin-right: 20px;padding-left: 50px;padding-right: 50px;">Huỷ
                    </button></a>
                    <button class="btn btn-primary ml-3" type="submit" style="padding-right: 50px;padding-left: 50px;">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
<!-- Danh sách đơn hàng mua-->
    <?php 
    if ($customer) {  ?>
        <div class="card border-0 rounded-0 mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col d-flex justify-content-between">
                        <p class="text-dark d-xl-flex fw-bold mt-2"><?=$data['subtitle1']?></p>
                    </div>
                </div>
                <div class="table-responsive" style="border: 0.5px solid rgb(227,227,227);">
                    <table class="table table-borderless">
                        <thead class="table-light" style="border-bottom-width: 0.5px;border-bottom-color: rgb(223, 224, 227);">
                            <tr>
                                <th>No.</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($count): ?>
                            <?php foreach ($orders as $index => $order):?>
                                <tr>
                                    <td><?= $index + 1 + 10*($page-1)?></td>
                                    <td><?=$order->ma_dh?></td>
                                    <td><?=$order->ngay_lap_dh?></td>
                                    <td><?=$order->trang_thai?></td>
                                    <td><?=formatPrice($order->thanh_tien)?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>  
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mt-3 text-dark">Tổng <strong><?= $count ?></strong> đơn hàng</p>
                    </div>
                    <div>
                        <nav class="text-end d-flex justify-content-end mt-3">
                            <?php
                                if($orders){
                                    $pagination->render();
                                }
                            ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
<!--Thống kê --> 
        <div class="card border-0 rounded-0 mt-3">
            <div class="card-body">
                <div class="col d-flex justify-content-between">
                    <p class="text-dark d-xl-flex fw-bold mt-2">Thống kê</p>
                </div>
                <div class="table-responsive" >
                    <table class="table border">
                            <tr>
                                <th class = "border col-sm-4" >Số đơn hàng thành công</th>
                                <td style = "padding-left: 30px"><?=$customer->so_don_hang?></td>
                            </tr>
                            <tr>
                                <th class = "border col-sm-4">Trị giá đơn đặt</th>
                                <td style = "padding-left: 30px"><?=formatPrice($customer->tri_gia)?></td>
                            </tr>
                    </table>
                </div>  
            </div>
        </div>    
    <?php }?>
</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>

<script>
    $(document).ready(function () {
        $('#customerForm').validate({
            rules: {
                ten_kh: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },  
            },
            messages: {
                ten_kh: {
                    required: "Tên khách hàng là bắt buộc",
                },
                email: {
                    required: "Email là bắt buộc",
                    email: "Vui lòng nhập đúng địa chỉ email"
                }
                
            },submitHandler: function(form) {
                form.submit();
            }
        });
    });

    $(document).ready(function () {
        <?php Session::danger('addCustomerFail')?>
        <?php Session::danger('UpdateCustomerFail')?>
        <?php Session::success('updateCustomerSuccess')?>
    })


    if($('#reset-password').length){
        $('#reset-password').on('click',function () {
            $(this).prop('disabled',true);
            $.ajax({
                method:"POST",
                url:'<?=getUrl('admin/customers/resetPassword')?>',
                data:{
                    id: <?=$customer->ma_kh?>,
                    email: "<?=$customer->email?>"
                },
                dataType: "json",
                success: function(data,state) {
                    if(data.status){
                        FuiToast.success(data.message);
                        $(this).prop('disabled',false);
                    }else{
                        FuiToast.error(data.message);
                        $(this).prop('disabled',false);
                    }
                }
            })
        })
    }
</script>