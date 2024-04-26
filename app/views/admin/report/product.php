
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

<?php
$report = $data['report'];
$reportPros = $data['reportPros'];
$count = $data['reportPros'] ? count($data['reportPros']) : 0;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($reportPros){
        $records_per_page = 10;
        $pagination = new Zebra_Pagination();
        $pagination->records(count($reportPros));
        $pagination->records_per_page($records_per_page);
        $reportPros = array_slice(
            $reportPros,
            (($pagination->get_page() - 1) * $records_per_page),
            $records_per_page
        );
    }
//var_dump($report);

?>
<!--Tim Kiem-->
<div class="container-fluid">
    <div class="card border-0 rounded-0" style="margin-top: 0px;">
        <div class="card-body">
            <form class="text-dark">
                <div class="row">
        
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="from_date"><strong>Từ ngày</strong></label>
                            <input
                                     class="form-control" type="date"
                                    name="from_date"/></div>
                    </div>
                    
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="to_date"><strong>Đến ngày</strong></label>
                        <input  class="form-control" type="date" name="to_date"/></div>
                    </div>
                    <div class="col">
                        <div class="mb-3"><label class="form-label"><strong>Sắp xếp số lượng</strong></label>
                            <select class="form-select" name="order">
                                <optgroup label="Sắp xếp số lượng">
                                    <option value="DESC">Giảm dần</option>
                                    <option value="ASC">Tăng dần</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success ml-3" type="submit" style="margin-right: 20px;">Xuất Excel</button>
                    <a href="<?=getUrl('admin/report')?>"><button class="btn btn-secondary" type="button" style="margin-right: 20px;">Làm mới</button></a>
                    <button class="btn btn-primary ml-3" type="submit" >Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

<!--Report -->
    <div class="card border-0 rounded-0 mt-3" > 
        <div class="card-title">   
           <!-- <div class="row" style="background: #ffffff;margin-left: -12px;"> .-->
                <div class="col-md-12" style=" margin-left: 18px;padding-top: 20px;height: 40px;">
                    <p class="fw-bold">BÁO CÁO THEO SẢN PHẨM</p>
                </div>
        </div>
        <div class="card-body">             
            <div class="row" style="border: 0.5px solid #ccc;padding-top: 17px; margin-left: 1px; margin-right: 1px">

                <div class="col-md-3"><span class="fw-semibold">Đơn hàng</span>
                    <p style="font-size: 31px;"><?=$report->so_luong_dh?> </p>
                </div>
                <div class="col-md-3" ><span class="fw-semibold">Sản phẩm bán ra</span>
                    <p style="font-size: 31px;"><?=($report->so_sp_ban) ? ($report->so_sp_ban) : 0 ?></p>
                </div>
                
                <div class="col-md-3" ><span class="fw-semibold">Doanh thu</span>
                    <p style="font-size: 31px;"><?=($report->doanh_thu) ? formatPrice($report->doanh_thu) : formatPrice(0) ?></p>
                </div>
                <div class="col-md-3" ><span class="fw-semibold">Lợi nhuận</span>
                    <p style="font-size: 31px;"><?=($report->loi_nhuan) ? formatPrice($report->loi_nhuan) : formatPrice(0) ?></p>
                </div>
            </div>
        </div>
        <div class="card-body"> 
           <!-- <div class="row" style="margin-left: 12px;margin-right: 12px; margin-top: 30px;">   -->
                <div class="table-responsive" style="border: 0.5px solid rgb(227,227,227);">
                    <table class="table table-borderless">
                        <thead class="table-light"
                            style="border-bottom-width: 0.5px;border-bottom-color: rgb(223, 224, 227);">
                        <tr>
                            <th>No.</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng bán</th>
                            <th>Doanh thu</th>
                            <th>Lợi nhuận</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php  if ($count): ?>
                        <?php  foreach ($reportPros as $index => $reportPro):?>
                            <tr>
                                <td><?= $index + 1 + 10*($page-1)?></td>
                                <td><?=$reportPro->ma_sp?></td>
                                <td><?=$reportPro->ten_sp?></td>
                                <td><?=$reportPro->so_sp_ban?></td>
                                <td><?=formatPrice($reportPro->doanh_thu)?></td>
                                <td><?=formatPrice($reportPro->loi_nhuan)?></td>                          
                            </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                        </tbody>   
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mt-3 text-dark">Tổng <strong><?= $count ?></strong> sản phẩm</p>
                    </div>
                    <div>
                        <nav class="text-end d-flex justify-content-end mt-3">
                            <?php
                            if($reportPros){
                                $pagination->render();
                            }
                            ?>
                        </nav>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<?php require_once ROOT ."/views/inc/adminFooter.php" ?>

