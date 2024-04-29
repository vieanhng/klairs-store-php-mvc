<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<?php
isset($data['product']) ? $product = $data['product'] : $product = false;
isset($data['product_categories']) ? $category = $data['product_categories'] : $category = false;


?>

<div class="container-fluid">
    <div class="card border-0 rounded-0" style="margin-top: 0px;">
        <div class="card-body">
            <form id="productForm" class="text-dark" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="ma_sp"><strong>Mã sản
                                    phẩm</strong></label><input class="form-control" type="text"
                                                                placeholder="Nhập mã sản phẩm" <?=$product ? "value={$product->ma_sp}" : "name=ma_sp" ?> ></div>
                        <div class="mb-3"><label class="form-label" for="ten_sp"><strong>Tên sản phẩm</strong></label>
                            <input
                                    class="form-control" type="text" placeholder="Nhập tên sản phẩm"
                                    name="ten_sp" value="<?= $product ? $product->ten_sp : ""?>" ></div>
                        <div class="row">
                            <div class="col-xxl-4">
                                <div class="mb-3"><label class="form-label" for="so_luong"><strong>Số
                                            lượng</strong></label>
                                    <input class="form-control" type="number" name="so_luong" <?= $product ? "value={$product->so_luong}" : ""?> />
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-inline-flex justify-content-between"
                                     style="width: 269.367px;margin-top: 31px;">
                                    <input id="add_sl" class="form-control" type="number" style="width: 180.672px"/>
                                    <button id="button_add" class="btn btn-primary" type="button">Thêm</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label" for="don_gia_nhap"><strong>Giá
                                    nhập</strong></label>
                            <input class="form-control" type="text"
                                                                placeholder="Nhập giá nhập" name="don_gia_nhap"
                                <?= $product ? "value=".(float)$product->don_gia_nhap : ""?>
                            /></div>
                    </div>
                    <div class="col">
                        <img id="productImg" width="196" height="202"  src="<?= $product ? getProductImage($product->anh_sp) : "#"?>"
                                          style="height: 180px;width: 182px;margin-bottom: 21px;" />
                        <input id="productImgInput" onchange="readURL(this);"
                                class="form-control" type="file" style="margin-bottom: 18px;" name="anh_sp"/>
                        <div class="mb-3"><label class="form-label" for="don_gia_ban"><strong>Giá
                                    bán</strong></label>
                            <input class="form-control" type="text"
                                   placeholder="Nhập giá bán" name="don_gia_ban"  <?= $product ? "value=".(float)$product->don_gia_ban : ""?>
                            /></div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3"><label class="form-label" for="danh_muc"><strong>Danh mục</strong></label>
                        <select id="select-tags" multiple data-placeholder="Chọn danh mục" class="form-control" name="danh_muc[]">
                            <optgroup label="Chọn danh mục">
                                <?php foreach ($data['cats'] as $cat):?>
                                <option value="<?=$cat->ma_danh_muc?>"  <?= $category && in_array($cat->ma_danh_muc,$category)  ? "selected" : ""?> ><?=$cat->ten_danh_muc?></option>
                                <?php endforeach;?>
                            </optgroup>
                        </select>


                    </div>
                    <div class="mb-3"><label class="form-label" for="username"><strong>Mô tả</strong></label><textarea
                                class="form-control" style="height: 157px;" name="mo_ta"><?= $product ? $product->mo_ta : ""?></textarea></div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="<?=getUrl('admin/products')?>"><button class="btn btn-secondary" type="button"
                            style="margin-right: 20px;padding-left: 40px;padding-right: 40px;">Huỷ
                    </button></a>
                    <button class="btn btn-primary ml-3" type="submit" style="padding-right: 40px;padding-left: 40px;">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>
<script>

    new TomSelect("#select-tags",{
        plugins: ['remove_button'],
        onItemAdd:function(){
            this.setTextboxValue('');
            this.refreshOptions();
        },
        render:{
            option:function(data,escape){
                return '<div class="d-flex"><span>' + escape(data.text) + '</span></div>';
            },
            item:function(data,escape){
                return '<div>' + escape(data.text) + '</div>';
            }
        }
    });


</script>

<script>
    $(document).ready(function () {
        let inputSoluong = $('input[name="so_luong"]');
        let inputAddValue = $('input#add_sl');
        $('#button_add').on('click',function () {
            let sl = inputSoluong.val();
            let valueAdd = inputAddValue.val();

            inputSoluong.val(Number(sl) + Number(valueAdd))
        })
    })
</script>

<script>
    $(document).ready(function () {
        $('#productForm').validate({
            rules: {
                ma_sp: {
                    required: true,
                },
                ten_sp: {
                    required: true
                },
                don_gia_nhap: {
                    required: true,
                    digits: true
                },
                don_gia_ban: {
                    required: true,
                    digits: true
                },
                <?php if(!$product): ?>
                anh_sp: {
                    required: true
                },
                <?php endif; ?>
                danh_muc: {
                    required: true
                },
                so_luong: {
                    required: true,
                    digits: true
                },
            },
            messages: {
                ma_sp: {
                    required: "Mã sản phẩm là bắt buộc",
                },
                ten_sp: {
                    required: "Tên sản phẩm là bắt buộc"
                },
                don_gia_nhap: {
                    required: "Giá nhập là bắt buộc",
                    digits: "Giá nhập phải là số"
                },
                don_gia_ban: {
                    required: "Giá bán là bắt buộc",
                    digits: "Giá bán phải là số"
                },
                <?php if(!$product): ?>
                anh_sp: {
                    required: "Ảnh sản phẩm là bắt buộc"
                },
                <?php endif; ?>
                danh_muc: {
                    required: "Danh mục là bắt buộc"
                },
                so_luong: {
                    required: "Số lượng là bắt buộc",
                    digits: "Số lượng phải là số"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#productImg')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function () {
        <?php Session::danger('addProductFail')?>
        <?php Session::danger('UpdateProductFail')?>
        <?php Session::success('updateProductSuccess')?>
    })
</script>