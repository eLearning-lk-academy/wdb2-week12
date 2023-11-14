<?php 

class ProductsController extends AdminController{

    private $model;
    public function __construct(){
        $this->model = new ProductModel();
    }

    public function index(){
        $viewArgs = ['title' => "All Products"];

        $viewArgs['products'] = $this->model->getAllProducts();
        $viewArgs['breadCrumbs'] = [
            'Dashboard' => 'admin',
            'Products' => 'admin/products',
        ];

        matchPath('admin/products');

        return adminView("products.index", $viewArgs );
    }

    public function add(){
        $viewArgs = ['title' => "All Products"];
        $viewArgs['breadCrumbs'] = [
            'Dashboard' => 'admin',
            'Products' => 'admin/products',
            'Add' => 'admin/products/add',
        ];
        return adminView("products.add", $viewArgs);
    }

    public function save(){
        $data = [
            'title' => $_POST['title'],
            'slug' => $_POST['slug'],
            'price'=> $_POST['price'],
            'sale_price' => $_POST['sale_price'],
            'description' => $_POST['description'],
        ];

        $id = $this->model->add($data);
        if($id){
            header('location: '.base_url('admin/products/edit/'.$id));
        }
    }

    public function edit($id){
        $viewArgs = ['title' => "All Products"];
        $viewArgs['breadCrumbs'] = [
            'Dashboard' => 'admin',
            'Products' => 'admin/products',
            'Add' => 'admin/products/add',
        ];
        $viewArgs['product'] = $this->model->getById($id);
        
        return adminView('products.edit', $viewArgs);
    }

    public function update($id){
        
        $data = [
            'title' => $_POST['title'],
            'slug' => $_POST['slug'],
            'price'=> $_POST['price'],
            'sale_price' => $_POST['sale_price'],
            'description' => $_POST['description'],
        ];

        $result = $this->model->update($id, $data);
        if($result){
            header('location: '.base_url('admin/products/edit/'.$id));
        }
    }

    public function delete($id){
        $result = $this->model->delete($id);
        if($result){
            header('location: '.base_url('admin/products'));
        }
    }
}