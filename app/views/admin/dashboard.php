
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

<?php
$sellToday = $data['sellToday'];
$topPros = $data['topPro'];
$count = $data['topPro'] ? count($data['topPro']) : 0;
$revenues = $data['revenues'];

//var_dump(json_encode($revenues));
?>

<div class="container-fluid content-container" style="background: #ffffff;border-radius: 5px;width: auto;margin-left: 25px;margin-right: 25px;margin-bottom: 25px;">
    <div class="row" style="background: #ffffff;margin-left: -12px;">
        <div class="col-md-12" style="padding-top: 17px;height: 51px;">
            <p class="fw-bold">KẾT QUẢ BÁN HÀNG HÔM NAY</p>
        </div>
    </div>
    <div class="row" style="margin-left: 12px;margin-right: 12px;margin-top: 9px;">
        <div class="col-md-3"><span class="fw-semibold">Đơn hàng</span>
            <p style="font-size: 31px;"><?=$sellToday->so_luong_dh?> </p>
        </div>
        <div class="col-md-3"><span class="fw-semibold">Sản phẩm bán ra</span>
            <p style="font-size: 31px;"><?=($sellToday->so_sp_ban) ? ($sellToday->so_sp_ban) : 0 ?></p>
        </div>
        
        <div class="col-md-3"><span class="fw-semibold">Doanh thu</span>
            <p style="font-size: 31px;"><?=($sellToday->doanh_thu) ? formatPrice($sellToday->doanh_thu) : formatPrice(0) ?></p>
        </div>
        <div class="col-md-3"><span class="fw-semibold">Lợi nhuận</span>
            <p style="font-size: 31px;"><?=($sellToday->loi_nhuan) ? formatPrice($sellToday->loi_nhuan) : formatPrice(0) ?></p>
        </div>
    </div>
</div>
<div class="container-fluid content-container">
    <div class="row">
        <div class="col-md-12 d-inline-flex justify-content-between" style="padding-top: 20px;height: 61px;padding-bottom: 0px;">
            <div>
                <p class="fw-bold">DOANH THU THEO THÁNG</p>
            </div>

        </div>
        <div class="col">
            <div class="card shadow-none mb-4" style="border-style: none;">
                <div class="chart-area" style="border-style: none;" id="myChart">
                    <canvas id="acquisitions" height="500" width="2248" style="display: block; height: 320px; width: 1124px;">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid content-container">
    <div class="row">
        <div class="col-md-12 d-inline-flex justify-content-between" style="padding-top: 20px;height: 61px;padding-bottom: 0px;">
            <div>
                <p class="fw-bold">TOP 5 SẢN PHẨM BÁN CHẠY</p>
            </div>
        </div>
        <div class="col" style="padding-right: 0px;padding-left: 0px;">
            <div class="table-responsive d-xl-flex table-striped" style="width: auto;">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Doanh thu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <?php if($count):?>
                        <?php foreach ($topPros as $index => $topPro):?>
                            <tr>
                                <td><?= $index + 1?></td>
                                <td><?=$topPro->anh_sp?></td>
                                <td><?=$topPro->ten_sp?></td>
                                <td><?=$topPro->so_sp_ban?></td>
                                <td><?=formatPrice($topPro->doanh_thu)?></td>
                        <?php endforeach;?>
                    <?php endif;?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <p class="mt-3 text-dark">Tổng <strong><?= $count ?></strong> sản phẩm</p>
                </div>
            </div>    
        </div>
    </div>
</div>
<?php require_once ROOT ."/views/inc/adminFooter.php" ?>

<script>
    // Sample data for each month
    (async function() {

        // $.post("controller.Orders.php",
        //     function (revenues){
        //         console.log(revenues);
        //         var data = [];
        //         //var result = [];
        //         for (var j in data){
        //             for (var i in revenues) {
        //                 j->year.push(revenues[i].thang_nam);
        //                 j->count.push(revenues[i].doanh_thu);
        //         }
                
                
        //         }
        //     }
        // )   
        const data = <?php echo json_encode($revenues);?>;
        
        new Chart(
            document.getElementById('acquisitions'),
            {
                type: 'bar',
                data: {
                    labels: data.map(row => row.thang_nam),
                    datasets: [
                        {
                            label: 'Doanh thu theo tháng',
                            backgroundColor: "#0043c4",
                            data: data.map(row =>Number(row.doanh_thu))
                        }
                    ]
                }
            }
        );
    })();
</script>
