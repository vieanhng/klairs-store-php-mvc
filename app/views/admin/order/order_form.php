<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<div class="container-fluid">
    <h3 class="text-dark mb-4"></h3>
    <form>
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Cell 2</td>
                                    <td>Cell 2</td>
                                    <td>Cell 2</td>
                                    <td><input class="form-control" type="number" style="width: 80px;border-style: none;border-bottom-style: solid;border-radius: 0px;" value="1" /></td>
                                    <td>Cell 2</td>
                                    <td class="text-center"><svg class="icon icon-tabler icon-tabler-trash text-center" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="font-size: 20px;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="4" y1="7" x2="20" y2="7"></line>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Cell 4</td>
                                    <td>Cell 4</td>
                                    <td>Cell 4</td>
                                    <td><input class="form-control" type="number" style="width: 80px;border-style: none;border-bottom-style: solid;border-radius: 0px;" /></td>
                                    <td>Cell 4</td>
                                    <td class="text-center"><svg class="icon icon-tabler icon-tabler-trash text-center" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="font-size: 20px;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="4" y1="7" x2="20" y2="7"></line>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg></td>
                                </tr>
                                </tbody>
                            </table>
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
                                    <td class="text-end">100000đ</td>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển:</td>
                                    <td class="text-end">50000đ</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>Tổng tiền phải trả:</td>
                                    <td class="text-end">150000đ</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label" for="username"><strong>Khách hàng</strong></label><select class="form-select">
                                <optgroup label="This is a group">
                                    <option value="12" selected>This is item 1</option>
                                    <option value="13">This is item 2</option>
                                    <option value="14">This is item 3</option>
                                </optgroup>
                            </select></div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Thông tin nhận hàng</p>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3"><label class="form-label" for="username"><strong>Tên người nhận</strong></label><input id="ma_dh-1" class="form-control" type="text" placeholder="Nhập mã đơn hàng" name="ma_dh" /></div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3"><label class="form-label" for="username"><strong>Số điện thoại</strong></label><input id="ma_dh-2" class="form-control" type="text" placeholder="Nhập mã đơn hàng" name="ma_dh" /></div>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label" for="username"><strong>Địa chỉ giao hàng</strong></label><input id="ma_dh-3" class="form-control" type="text" placeholder="Nhập mã đơn hàng" name="ma_dh" /></div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Phương thức thanh toán</p>
                        </div>
                        <div class="d-inline-flex w-100">
                            <div class="form-check" style="width: 50%;"><input id="formCheck-1" class="form-check-input" type="radio" checked name="payment" /><label class="form-check-label" for="formCheck-1">Thanh toán khi nhận hàng</label></div>
                            <div class="form-check" style="width: 50%;"><input id="formCheck-2" class="form-check-input" type="radio" name="payment" /><label class="form-check-label" for="formCheck-2">Thanh toán online</label></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label" for="username"><strong>Mã/tên sản phẩm</strong></label><input id="ma_ten" class="form-control" type="text" placeholder="Nhập mã/tên sản phẩm" /></div>
                        <div class="mb-3"><label class="form-label" for="username"><strong>Danh mục</strong></label>
                            <select id="danhmuc" class="form-select">
                                <optgroup label="Chọn danh mục">
                                    <option >Tất cả</option>
                                    <?php foreach ($data['cats'] as $cat):?>
                                        <option value="<?=$cat->ma_danh_muc?>" ><?=$cat->ten_danh_muc?></option>
                                    <?php endforeach;?>
                                </optgroup>

                            </select></div>
                        <div class="d-flex justify-content-end"><button id="product-search" class="btn btn-primary float-end" type="button">Tìm kiếm</button></div>
                        <div id="product-box" style="max-height: 500px; overflow-y: auto">
                            <div class="card product-card">
                                <div class="card-body d-inline-flex justify-content-between align-items-xl-center">
                                    <div class="d-inline-flex align-items-xl-center float-start"><img width="100" height="80" />
                                        <div style="margin-left: 15px;">
                                            <div class="product-name">Product name</div>
                                            <div class="product-price text-primary">1000</div>
                                        </div>
                                    </div>
                                    <div class="stock" style="position: absolute;right: 10px;bottom: 10px;"><span>Kho: 20</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;background: rgba(255,255,255,0);">
                    <div class="card-body d-inline-flex justify-content-between" style="background: rgba(255,255,255,0);padding-left: 0px;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;margin-bottom: -1px;"><button class="btn btn-secondary w-50" type="button" style="margin-right: 5px;">Huỷ</button><button class="btn btn-primary w-50" type="button" style="margin-left: 5px;">Lưu</button></div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>

<script>
    $(document).ready(function () {
        function getProductCard(productId, productName, productPrice, image, stock){
            return `
                    <div class="card product-card" data-tenSp="${productName}"
                                                    data-maSp="${productId}"
                                                    data-giaSp="${productPrice}"
                                                                                >
                        <div class="card-body d-inline-flex justify-content-between align-items-xl-center">
                            <div class="d-inline-flex align-items-xl-center float-start"><img width="80" height="80" src="${getImageUrl(image)}" />
                                <div style="margin-left: 15px;">
                                    <div class="product-name">${productName}</div>
                                    <div class="product-price text-primary">${formatPrice(productPrice)}</div>
                                </div>
                            </div>
                            <div class="stock" style="position: absolute;right: 10px;bottom: 10px;"><span>Kho: ${stock}</span></div>
                        </div>
                    </div>
            `
        }

        function formatPrice(price) {
            let priceString = Number(price).toString();
            let formattedPrice = priceString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            formattedPrice += "đ";

            return formattedPrice;
        }

        function getImageUrl(image){
            return BASE_URL+'public/uploads/product/'+image;
        }


        function getProductResult(maten,danhmuc){
            $('#product-box').html('');
            $.ajax({
                method:"POST",
                url:'<?=getUrl('products/ajaxProductCategory')?>',
                data:{
                    ma_ten:maten,
                    cat:danhmuc
                },
                dataType: "json",
                success: function(data,state) {
                    data.forEach(
                        item => $('#product-box').append(getProductCard(item.ma_sp,item.ten_sp,item.don_gia_ban,item.anh_sp,item.so_luong))
                    )
                }
            })

        }
        getProductResult('','');
        $('#product-search').on('click',function () {
            let ma_ten = $('#ma_ten').val();
            let cats = $('#danhmuc').val();
            getProductResult(ma_ten,cats)
        })

        function addProduct(ma_sp){
            let localData = localStorage.getItem('products');
            if(!localData){
                localStorage.setItem('products',JSON.stringify([]));
                localData = localStorage.getItem('products');
            }
            let data = JSON.parse(localData);

            data.push([ma_sp]);
            localStorage.setItem('products',JSON.stringify(data));
        }


        $(document).on('click','.product-card',function () {
            addProduct($(this).data('masp'));
        })

    })
</script>