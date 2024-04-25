<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<?php
$payments = $data['payments'];
?>

<div class="container-fluid">
    <div class="card border-0 rounded-0" style="margin-top: 0px;">
        <div class="card-body">
            <div class="col d-flex justify-content-between">
                <p class="text-dark d-xl-flex fw-bold mt-2">Danh sách phương thức thanh toán</p>
            </div>
            <div class="table-responsive" style="border: 0.5px solid rgb(227,227,227);">
                <table class="table table-borderless">
                    <thead class="table-light" style="border-bottom-width: 0.5px;border-bottom-color: rgb(223, 224, 227);">
                    <tr>
                        <th>#</th>
                        <th>Mã</th>
                        <th>Trạng thái</th>
                        <th>Tên PTTT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $index =>$payment):?>
                    <tr>
                        <td><?=++$index?></td>
                        <td><?=$payment->ma_pttt?></td>
                        <td>
                            <div class="form-check form-switch">
                                <input data-id="<?=$payment->ma_pttt?>" <?=$payment->trang_thai == 1 ? 'checked' : ''?>  class="form-check-input payment-status" type="checkbox" />
                            </div>
                        </td>
                        <td><?=$payment->ten_pttt?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>

<script>
    $(document).ready(function () {
        $('.payment-status').on('change',function () {
            const paymentId = $(this).data('id');
            const status = $(this).prop('checked');

            $.ajax({
                method:"POST",
                url:'<?=getUrl('admin/payments/updatestatus')?>',
                data:{
                    id:paymentId,
                    status:status
                },
                dataType: "json",
                success: function(data,state) {
                    if(data.status){
                        FuiToast.success(data.message);
                    }else{
                        FuiToast.error(data.message);
                    }


                }
            })
        })
    })
</script>