<?php

class Products extends Controller
{

    protected Product $productModel;

    const title = 'Quản lý sản phẩm';

    public function __construct()
    {
        $this->productModel = $this->model('Product');
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $data['title'] = self::title;
        $data['subtitle'] = 'Danh sách sản phẩm';

        $cats = $this->categoryModel->getCategories();
        $products = $this->productModel->getProducts($_GET);
        $data['cats'] = $cats;
        $data['products'] = $products;


        $this->view('admin.product.product_grid', $data);
    }

    public function create()
    {
        $data['title'] = self::title;
        $data['subtitle'] = 'Thêm mới sản phẩm';

        $cats = $this->categoryModel->getCategories();
        $data['cats'] = $cats;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {

                isset($_POST['ma_sp']) ? $ma_sp = $_POST['ma_sp'] : $ma_sp = '';
                if($this->productModel->getProductById($ma_sp)){
                    Session::set('addProductFail', 'Sản phẩm đã tồn tại');
                    Redirect::back();
                }
                isset($_POST['ten_sp']) ? $ten_sp = $_POST['ten_sp'] : $ten_sp = '';
                isset($_POST['so_luong']) ? $soluong = $_POST['so_luong'] : $soluong = '';
                isset($_POST['don_gia_ban']) ? $gia_ban = $_POST['don_gia_ban'] : $gia_ban = '';
                isset($_POST['don_gia_nhap']) ? $gia_nhap = $_POST['don_gia_nhap'] : $gia_nhap = '';
                isset($_POST['mo_ta']) ? $mota = $_POST['mo_ta'] : $mota = '';
                isset($_POST['danh_muc']) ? $danh_muc = $_POST['danh_muc'] : $danh_muc = '';
                $anh_sp = '';
                if(isset($_FILES["anh_sp"]) && $_FILES["anh_sp"]["error"] == 0){
                    $target_dir = dirname(ROOT)."/public/uploads/product/";
                    $anh_sp = $target_dir . basename($_FILES["anh_sp"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($anh_sp,PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["anh_sp"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }

                    if ($_FILES["anh_sp"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } else {
                        if (!move_uploaded_file($_FILES["anh_sp"]["tmp_name"], $anh_sp)) {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                } else {
                    echo "No file uploaded";
                }

                $this->productModel->addNewProduct(
                    $ma_sp,
                    $ten_sp,
                    $anh_sp,
                    $gia_nhap,
                    $gia_ban,
                    $soluong,
                    $mota,
                    $danh_muc
                );
                Session::set('addProductSuccess', 'Thêm sp thành công');
                Redirect::to('admin/products');

            } catch (\Exception $e) {
                Session::set('addProductFail', $e->getMessage());
                Redirect::to('admin/products');
            }

        }
        $this->view('admin.product.product_form', $data);
    }

    public function delete($param)
    {
        try {
            $id = $param['id'];
            $this->productModel->deleteProductById($id);
            Session::set('deleteProductSuccess', 'Xoá sản phẩm thành công');
            Redirect::to('admin/products');
        }catch (\Exception $e) {
            Session::set('deleteProductFail', $e->getMessage());
            Redirect::to('admin/products');
        }
    }

    
}