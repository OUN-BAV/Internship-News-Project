<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Tag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tag');
        CRUD::setEntityNameStrings('tag', 'tags');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableBulkActions();
        $this->crud->addButtonFromView('top','bulk_delete','end');
        $this->crud->enableExportButtons();

        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'select2',
            'label' => 'name',
          ], function() {
                $tag=Tag::all()->pluck('name')->toArray();
                return $tag;
          }, function($value) { // if the filter is active
                $tag=Tag::all()->pluck('name')->toArray();
                $this->crud->addClause('where', 'name', $tag[$value]);
         });

        CRUD::column('name');
        CRUD::column('created_at');
        CRUD::column('updated_at');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TagRequest::class);

        CRUD::field('name');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function getTagById($name){
        $tags = Tag::where('name', $name)->with('posts')->get();
        $data['categories']=Category::all();
        $data['tags'] = Tag::all();
        $data['ads']=Ads::paginate(1);
        $data['posts'] = $tags[0]->posts;
        return view('index',$data);
    }
}
