<?php
class Categories extends Controller
{

    protected Category $categoryModel;

    const title = 'Quản lý danh mục';

    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
    }
// Danh sách danh mục
    public function index()
    {
        $data['title'] = self::title;
        $data['subtitle'] = 'Danh sách danh mục';

        $cats = $this->categoryModel->getAllCat($_GET);
        $data['cats'] = $cats;


        $this->view('admin.categories.category_grid', $data);
    }
// Thêm mới danh mục
    public function create()
    {
        $data['title'] = self::title;
        $data['subtitle'] = 'Thêm mới danh mục';


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {

                isset($_POST['ma_dm']) ? $ma_dm = $_POST['ma_dm'] : $ma_dm = '';
                if($this->categoryModel->getCategoryById($ma_dm)){
                    Session::set('addCategoryFail', 'Danh mục đã tồn tại');
                    Redirect::back();
                }
                isset($_POST['ten_dm']) ? $ten_dm = $_POST['ten_dm'] : $ten_dm = '';
                isset($_POST['mo_ta']) ? $mo_ta = $_POST['mo_ta'] : $mo_ta = '';
                
                $this->categoryModel->addNewCategory(
                    $ma_dm,
                    $ten_dm,
                    $mo_ta
                );
                Session::set('addCategorySuccess', 'Thêm danh mục thành công');
                Redirect::to('admin/Categories');

            } catch (\Exception $e) {
                Session::set('addCategoryFail', $e->getMessage());
                Redirect::to('admin/Categories');
            }

        }
        $this->view('admin.categories.category_form', $data);
    }
// Xóa danh mục
    public function delete($param)
        {
            $id = $param['id'];
            try {
                $this->categoryModel->deleteCategory($id);
                Session::set('deleteCategorySuccess','Xoá danh mục thành công.');
                Redirect::back();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // Cập nhật danh mục
    public function edit($param){
        $data['title'] = self::title;
        $data['subtitle'] = 'Cập nhật danh mục';
        try {
            Auth::adminAuth();
            $id = $param['id'];
            $data['cats'] = $this->categoryModel->getCategoryById($id);
           
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                try {

                    isset($_POST['ten_dm']) ? $ten_dm = $_POST['ten_dm'] : $ten_dm = '';
                    isset($_POST['mo_ta']) ? $mo_ta = $_POST['mo_ta'] : $mo_ta = '';
    
                    $this->categoryModel->updateCategory(
                        $id,
                        $ten_dm,
                        $mo_ta,
        
                    );
                    Session::set('updateCategorySuccess', 'Cập nhật thành công');
                    Redirect::back();

                } catch (\Exception $e) {
                    Session::set('UpdateCategoryFail', $e->getMessage());
                    Redirect::to('admin/categories');
                }

            }
        }catch (Exception $e){
            Session::set('editCategoryFail', $e->getMessage());
        }


        $this->view('admin.categories.category_form', $data);
    }
}




?>