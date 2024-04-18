<?php 

    class Products extends Controller {
        private Product  $productModel;
        private $categoryModel;
        public function __construct(){
            $this->productModel = $this->model('Product');
            $this->categoryModel = $this->model('Category');
        }

        public function index(){
            $data['title'] = 'Tất cả sản phẩm';
            $data['search'] = '';
            if(isset($_GET['search'])){
                $data['search'] = $_GET['search'];
                $data['title'] = "Kết quả tìm kiếm cho ". "\"".$data["search"]."\"";
            }


            $data['products'] = $this->productModel->getAllPro($data['search']);
            $this->view('products.all',$data);
        }

        public function detail($params){
            $data['title'] = 'Thông tin sản phẩm';
            $productId = $params['id'];
            $product = $this->productModel->getProductById($productId);
            if($product){
                $data['product'] = $product;
            }else {
                Redirect::to('');
                exit();
            }
            $this->view('products.detail',$data);
        }
    }