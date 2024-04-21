<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>
<?php
$customers = $data['customers'];

    $count = $data['customers'] ? count($data['customers']) : 0;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($customers){
        $records_per_page = 10;
        $pagination = new Zebra_Pagination();
        $pagination->records(count($customers));
        $pagination->records_per_page($records_per_page);
        $customers = array_slice(
            $customers,
            (($pagination->get_page() - 1) * $records_per_page),
            $records_per_page
        );
    }

?>
<div class="container-fluid">
    <div class="card border-0 rounded-0" style="margin-top: 0px;">
        <div class="card-body">
            <form class="text-dark" >
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="email_ten"><strong>Khách hàng</strong></label>
                            <input class="form-control" type="text"
                                                                placeholder="Nhập email/tên khách hàng" name="email_ten"/></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="<?=getUrl('admin/customers')?>"><button class="btn btn-secondary" type="button" style="margin-right: 20px;">Làm mới</button></a>
                    <button class="btn btn-primary ml-3" type="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0 rounded-0 mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-between">
                    <p class="text-dark d-xl-flex fw-bold mt-2"><?=$data['subtitle']?></p>

                    <a href="<?=getUrl('admin/customers/create')?>"><button class="btn btn-primary" type="button" style="height: 80%;">
                            <svg class="icon icon-tabler icon-tabler-circle-plus" xmlns="http://www.w3.org/2000/svg"
                                 width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 style="margin-bottom: 3px;margin-right: 7px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="9" y1="12" x2="15" y2="12"></line>
                                <line x1="12" y1="9" x2="12" y2="15"></line>
                            </svg>
                            Thêm mới khách hàng
                        </button>
                    </a>
                </div>
            </div>
            <div class="table-responsive" style="border: 0.5px solid rgb(227,227,227);">
                <table class="table table-borderless">
                    <thead class="table-light"
                           style="border-bottom-width: 0.5px;border-bottom-color: rgb(223, 224, 227);">
                    <tr>
                        <th>No.</th>
                        <th>MKH</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Số đơn hàng</th>
                        <th>Trị giá</th>
                        <th></th>
                        <th></th>
                    </tr>
                    
                    </thead>
                    
                    <tbody>
                    <?php  if ($count): ?>
                    <?php  foreach ($customers as $index => $customer):?>
                        <tr>
                            <td><?= $index + 1 + 10*($page-1)?></td>
                            <td><?=$customer->ma_kh?></td>
                            <td><?=$customer->ten_kh?></td>
                            <td><?=$customer->email?></td>
                            <td><?=$customer->dien_thoai?></td>
                            <td><?=$customer->so_don_hang?></td>
                            <td><?=formatPrice($customer->tri_gia)?></td>

                            <td class="text-center">
                                <a href="<?=getUrl('admin/customers/edit/id/'.$customer->ma_kh)?>">
                                    <svg class="icon icon-tabler icon-tabler-edit text-center"
                                         xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                        <line x1="16" y1="5" x2="19" y2="8"></line>
                                    </svg>
                                </a>
                            </td>
                            <td class="text-center">
                                <a style="cursor: pointer"  data-bs-target="#modal-1" data-bs-toggle="modal" data-customerId="<?=$customer->ma_kh?>">
                                    <svg class="icon icon-tabler icon-tabler-trash text-center"
                                         xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                    
                </table>
            
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <p class="mt-3 text-dark">Tổng <strong><?= $count ?></strong> khách hàng</p>
                </div>
                <div>
                    <nav class="text-end d-flex justify-content-end mt-3">
                        <?php
                        if($customers){
                            $pagination->render();
                        }
                        ?>
                    </nav>
                </div>
            </div>
           
        </div>
    </div>
</div>

<div id="modal-1" class="modal fade " role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body text-dark" style="height: 235px;">
                <p class="fs-3 text-center" style="margin-top: 32px;"><strong>Xoá khách hàng</strong></p>
                <p class="text-center" style="margin-top: 24px;">Bạn có chắc chắn muốn xóa khách hàng này?</p>
                <p class="text-center text-danger" style="margin-top: 15px; margin-left: 20px;margin-right: 20px; ">Lưu ý: Việc xóa khách hàng đồng nghĩa với việc xóa toàn bộ đơn hàng ứng với khách hàng này</p>
            </div>
            <div class="modal-footer d-inline-flex d-xxl-flex justify-content-around" style="border-style: none;height: 100px;">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal" style="margin-left: 1px;margin-right: 0px;padding-left: 40px;padding-right: 40px;padding-bottom: 10px;padding-top: 10px;">Huỷ bỏ</button>
                <a onclick="deleteCustomer(customerId)">
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
        <?php Session::success('deleteCustomerSuccess')?>
        <?php Session::success('addCustomerSuccess')?>
        <?php Session::danger('deleteCustomerFail')?>
        <?php Session::danger('addCustomerFail')?>
    })

    let customerId = '';
    $('#modal-1').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        customerId = button.data('customerid');
    });

    function deleteCustomer(customerId) {
        window.location.href = "<?=getUrl('admin/customers/delete/id/')?>" + customerId;
    }
</script>
 