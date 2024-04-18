<?php 

    class Categories extends Controller {
        private Category $categoryModel;
        public function __construct(){
            $this->categoryModel = $this->model('Category');
        }

        public function category($param){
            $categryId = $param['cat'];
            $category = $this->categoryModel->getCategoryById($categryId);
            $data['title'] = $category->ten_danh_muc;
            $data['products'] = $this->categoryModel->getCategoryProductCollection($categryId);
            $this->view('products.all', $data);
        }
    }