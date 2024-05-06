<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<div class="container-fluid">
    <h3 class="text-dark mb-4"></h3>
    <form id="order-form">
        <div class="row mb-3">
            <div class="col-lg-7 col-xl-8">
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Sản phẩm</p>
                        </div>
                        <div class="table-responsive" style="border: 0.5px solid rgb(227,227,227);">
                            <table id="product-table" class="table table-borderless">
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
                                    <td id="product-total" class="text-end">100000đ</td>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển:</td>
                                    <td id="shipping-cost" class="text-end"><?= formatPrice(SHIPPING_COST) ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>Tổng tiền phải trả:</td>
                                    <td id="total" class="text-end">150000đ</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label" for="username"><strong>Khách hàng</strong></label>
                            <select class="form-select" name="customer">
                                <optgroup label="Chọn khách hàng...">
                                    <option value="1" selected>Guest</option>
                                    <?php foreach ($data['customers'] as $customer):?>
                                        <option value="<?=$customer->ma_kh?>">
                                            <?= $customer->ten_kh ."(".$customer->email.")"?>
                                        </option>
                                    <?php endforeach;?>
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
                                <div class="mb-3"><label class="form-label" for="name"><strong>Tên người nhận</strong></label>
                                    <input class="form-control" type="text" placeholder="Nhập tên người nhận" name="name" /></div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3"><label class="form-label" for="phone"><strong>Số điện thoại</strong></label>
                                    <input class="form-control" type="text" placeholder="Nhập số điện thoại" name="phone" /></div>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label" for="address"><strong>Địa chỉ giao hàng</strong></label>
                            <input class="form-control" type="text" placeholder="Nhập địa chỉ giao hàng" name="address" /></div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 mb-4" style="margin-top: 0px;">
                    <div class="card-body">
                        <div class="col d-flex justify-content-between">
                            <p class="text-dark d-xl-flex fw-bold mt-2">Phương thức thanh toán</p>
                        </div>
                        <div class="d-inline-flex w-100">
                            <?php foreach ($data['paymentMethods'] as $payment):?>

                            <div class="form-check" style="width: 50%;">
                                <input id="payment-<?=$payment->ma_pttt?>" type="radio" name="payment" <?=$payment->ma_pttt == 1 ? "checked": ""?> value="<?=$payment->ma_pttt?>">
                                <label class="checkbox-label" for="payment-<?=$payment->ma_pttt?>"><?=$payment->ten_pttt?></label>
                            </div>
                            <?php endforeach;?>
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
                    <div class="card-body d-inline-flex justify-content-between" style="background: rgba(255,255,255,0);padding-left: 0px;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;margin-bottom: -1px;">
                        <a class="btn btn-secondary w-50" href="<?=getUrl('admin/orders')?>" style="margin-right: 5px;" >Huỷ</a>
                        <button id="submit-button" class="btn btn-primary w-50" type="button" style="margin-left: 5px;">Lưu</button></div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>

<script>
    function getProductLocalData(){
        let localData = localStorage.getItem('products');

        if(!localData){
            localStorage.setItem('products',JSON.stringify([]));
            localData = localStorage.getItem('products');
        }

        return JSON.parse(localData);
    }

    function setProductLocalData(data){
        localStorage.setItem('products',JSON.stringify(data));
    }
    $(document).ready(function () {
        function getProductCard(productId, productName, productPrice, image, stock){
            return `
                    <div class="card product-card" data-tenSp="${productName}"
                                                    data-maSp="${productId}"
                                                    data-giaSp="${productPrice}"
                                                    data-stock="${stock}"
                                           style="cursor: pointer"                                     >
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

        setProductLocalData([]);

        function updateProductHtml(){
            let productData = getProductLocalData();
            let productTable = $('#product-table tbody').html('');

            productData.map(item => productTable.append(`
                    <tr>
                        <td>1</td>
                        <td>${item.ma_sp}</td>
                        <td>${item.ten_sp}</td>
                        <td>${formatPrice(item.don_gia_ban)}</td>
                        <td><input class="form-control product-qty" data-masp="${item.ma_sp}" data-stock="${item.so_luong}" type="number" style="width: 80px;border-style: none;border-bottom-style: solid;border-radius: 0px;" value="${item.qty}" /></td>
                        <td>${formatPrice(item.tong_tien)}</td>
                        <td class="text-center"><span data-masp="${item.ma_sp}" class="delete-product" style="cursor: pointer"><svg class="icon icon-tabler icon-tabler-trash text-center" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="font-size: 20px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg></span></td>
                    </tr>
            `))
        }
        updateProductHtml();

        function addProduct(ma_sp,stock){
            let products = getProductLocalData();
            let newProducts = [...products];
            const product = newProducts.find(item => item.ma_sp === ma_sp);
            if(product){
                if(product.qty < stock){
                    product.qty += Number(1);
                    product.tong_tien = Number(product.qty * product.don_gia_ban)
                    setProductLocalData(newProducts);
                    updateProductHtml();
                }else{
                    FuiToast.error('Số lượng kho không đủ.');
                }
            } else {
                $.ajax({
                    method:"POST",
                    url:'<?=getUrl('products/ajaxProductData')?>',
                    data:{
                        ma_sp:ma_sp
                    },
                    dataType: "json",
                    success: function(data,state) {
                        data.qty = 1;
                        data.tong_tien = data.don_gia_ban;
                        newProducts.push(data);
                        setProductLocalData(newProducts);
                        updateProductHtml();
                    }
                })

            }
        }

        function deleteProduct(ma_sp){
            let products = getProductLocalData();
            let newProducts = products.filter(item => item.ma_sp !== ma_sp);
            setProductLocalData(newProducts);
            updateProductHtml();
        }

        function updateTotal(){
            let productTotal = 0;
            let shippingCost = <?=SHIPPING_COST?>;

            let products = getProductLocalData();
            products.forEach((item)=>{
                productTotal += Number(item.don_gia_ban) * item.qty;
            })
            let total = productTotal + shippingCost;
            $('#product-total').text(formatPrice(productTotal));
            $('#total').text(formatPrice(total));
            localStorage.setItem('orderTotal',total)
        }
        updateTotal()

        $(document).on('click','.product-card',function () {
            addProduct($(this).data('masp'),$(this).data('stock'));
            setTimeout(function () {
                updateTotal()
            },700)
        })

        $(document).on('click','.delete-product',function () {
            deleteProduct($(this).data('masp'));
            setTimeout(function () {
                updateTotal()
            },700)
        })

        $(document).on('change','input.product-qty',function () {
            let products = getProductLocalData();
            let newProducts = [...products];
            const product = newProducts.find(item => item.ma_sp === $(this).data('masp'));
            if(product.qty < $(this).data('stock')){
                product.qty = Number($(this).val());
                product.tong_tien = Number(product.qty * product.don_gia_ban);
                setProductLocalData(newProducts);
                setTimeout(function () {
                    updateTotal()
                },700)
            }else{
                product.qty = Number($(this).data('stock'));
                $(this).val($(this).data('stock'))
                setProductLocalData(newProducts);
                FuiToast.error('Số lượng kho không đủ.');
            }

        })
    })
</script>
<script>
    $(document).ready(function () {
        $('#submit-button').on('click',function () {
            let button = $(this);
            button.prop("disabled", true);
            let productData = getProductLocalData();
            let orderTotal = localStorage.getItem('orderTotal');
            let formData = $('#order-form').serializeArray();
            const formObject = {};

            formData.forEach(item => {
                formObject[item.name] = item.value;
            });
            $.ajax({
                method:"POST",
                url:'<?=getUrl('admin/orders/create')?>',
                data:{
                    products:productData,
                    ...formObject,
                    orderTotal
                },
                dataType: "json",
                success: function(data,state) {
                    if(data.status){
                        window.location.href = BASE_URL + 'admin/orders';
                    }else{
                        FuiToast.error(data.message);
                        button.prop("disabled", false);
                    }


                }
            })
        })
    })
</script>