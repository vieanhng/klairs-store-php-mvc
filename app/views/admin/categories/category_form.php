<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<?php
isset($data['cats']) ? $category = $data['cats'] : $category = false;
?>

<div class="container-fluid">
    <div class="card border-0 rounded-0" style="margin-top: 0px;">
        <div class="card-body">
            <form id="categoryForm" class="text-dark" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="ma_dm"><strong>Mã danh mục</strong></label>
                                    <input class="form-control" type="text" 
                                                                placeholder="Nhập mã danh mục" <?=$category ? "value={$category->ma_danh_muc}" : "name=ma_dm" ?> ></div>
                        
                    </div> 
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="ten_dm"><strong>Tên danh mục</strong></label>
                            <input
                                    class="form-control" type="text" placeholder="Nhập tên danh mục"
                                    name="ten_dm" value = "<?= $category ? $category->ten_danh_muc : ""?>" ></div> 
                   
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="mo_ta"><strong>Mô tả</strong></label>
                            <input
                                    class="form-control" type="text" placeholder="Nhập mô tả"
                                    name="mo_ta" value= "<?= $category ? $category->mo_ta : ""?>" ></div>
                        
                    </div> 
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="<?=getUrl('admin/categories')?>"><button class="btn btn-secondary" type="button"
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
    $(document).ready(function () {
        $('#categoryForm').validate({
            rules: {
                ma_dm: {
                    required: true,
                },
                ten_dm: {
                    required: true
                },
                
            },
            messages: {
                ma_dm: {
                    required: "Mã danh mục là bắt buộc",
                },
                ten_dm: {
                    required: "Tên danh mục là bắt buộc"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function (e) {
    //             $('#productImg')
    //                 .attr('src', e.target.result);
    //         };

    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
    $(document).ready(function () {
        <?php Session::danger('addCategoryFail')?>
        <?php Session::danger('UpdateCategoryFail')?>
        <?php Session::success('updateCategorySuccess')?>
    })
</script>