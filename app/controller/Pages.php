<?php 

    class Pages extends Controller {


        private Category $categoryModel;
        private Product $productModel;


        public function __construct(){
            $this->categoryModel = $this->model('Category');
            $this->productModel = $this->model('Product');
            $this->orderModel = $this->model('Order');
        }
       

        public function index(){
            $data['title'] = 'Trang chủ';
            $data['categories'] = $this->categoryModel->getCategories();
            $data['products'] = $this->productModel->getAllPro();
            $this->view('front.index', $data);
        }



        public function search(){
            $data['title'] = 'Products';
            $searched = $_POST['search'];
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $results = $this->productModel->search($searched);
                $data['products'] = $results;
                $this->view('front.index', $data);
            }else {
                Redirect::to('home');
            }
            
        }


        public function getProByCat($cat_id){
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            $data['category'] = $this->categoryModel->show($cat_id);
            $data['products'] = $this->productModel->getProByCat($cat_id);
            
            $data['title1'] = $data['category']->cat_name;

            if($data['category'] && is_numeric($cat_id)){
                $this->view('front.ProCategory', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home');
            }
        }

        public function getProByMan($man_id){
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            $data['manufacture'] = $this->manufactureModel->show($man_id);
            $data['products'] = $this->productModel->getProByMan($man_id);
            
            $data['title1'] = $data['manufacture']->man_name;

            if($data['manufacture'] && is_numeric($man_id)){
                $this->view('front.ProManufacture', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home');
            }
            $this->view('front.ProManufacture', $data);
        }


        public function show($id){
            $data['product'] = $this->productModel->show($id);
            $data['title'] = $data['product']->name;
            $data['gallary'] = $this->productModel->getGallary($id);
            if($data['product'] && is_numeric($id)){
                $this->view('front.details', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home');
            }
            
        }

        public function contactUs(){
            $data['title'] = 'Liên hệ';
            $this->view('front.contactus',$data);
        }

        public function aboutus(){
            $data['title'] = 'Về chúng tôi';
            $this->view('front.about',$data);
        }

    }