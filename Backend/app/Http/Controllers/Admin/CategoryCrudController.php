<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('category', 'categories');
    }

    /**
     * Define what happens when the List operation is loaded.
     */
    protected function setupListOperation()
    {
        $this->crud->enableBulkActions();
        $this->crud->addButtonFromView('top','bulk_delete','end');
        
        CRUD::column('name');
        CRUD::column('created_at');
        CRUD::column('updated_at');
        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'select2',
            'label' => 'name',
          ], function() {
                $category=\App\Models\Category::all()->pluck('name')->toArray();
                return $category;
          }, function($value) { // if the filter is active
                $category=Category::all()->pluck('name')->toArray();
                $this->crud->addClause('where', 'name', $category[$value]);
         });
    }

    /**
     * Define what happens when the Create operation is loaded.
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CategoryRequest::class);
        CRUD::field('name');
    }

    /**
     * Define what happens when the Update operation is loaded.
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function getPostByCategory($category){
        $Category=Category::where('name',$category)->with('post')->get();
        $data['categories']=Category::all();
        $data['posts']=$Category[0]->post;
        $data['related_info']=Post::where('category_id',$Category[0]->id)->get();
        $data['ads']=Ads::paginate(1);
        return view('index',$data);
    }
}
