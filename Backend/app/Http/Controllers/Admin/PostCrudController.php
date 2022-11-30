<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Post;
use App\Models\Category;
use App\Traits\UploadTrait;
use Psy\Readline\Hoa\Console;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use UploadTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation { bulkDelete as traitBulkDelete; }


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableBulkActions();
        $this->crud->addButtonFromView('top', 'bulk_delete', 'bulk_delete', 'start');

        CRUD::column('title');
        CRUD::column('content');
        CRUD::column('category_id');
        CRUD::column('category_id');
        $this->crud->addColumn([
            'label' => 'Posted By',
            'name' => 'UserName',
            'type' => 'closure',
            'function' => function($entry){
                return $entry->UserName;
            }
        ]);

        $this->crud->addColumn([
            'label' => 'Gallery',
            'name' => 'gallery',
            'type' => 'closure',
            'function' => function($entry){
                foreach( $entry->galleries as $item ) {
                    echo "<img src='".asset('uploads/galleries/'.$item->url)."' style='width:50px; height:50px'/>";
                }
            }
        ]);
        CRUD::column('viewer');
        CRUD::addColumn([
            'label' => 'Thumbnail',
            'name' => 'thumbnail',
            'type' => 'closure',
            'function' => function ($data){
                echo "<img src='".asset('uploads/galleries/'.$data->thumbnail)."' style='width:50px; height:50px'/>";
            }
        ]);
        
        $this->crud->column('title');
        $this->crud->column('content');
      
        $this->crud->column('category_id');
        $this->crud->column('viewer');

        $this->crud->addFilter([
            'name'  => 'title',
            'type'  => 'select2',
            'label' => 'title',
            'attribute' => 'title',
          ], function() {
                $postTitle=Post::all()->pluck('title')->toArray();
                return $postTitle;
          }, function($value) { // if the filter is active
                $postTitle=Post::all()->pluck('title')->toArray();
                $this->crud->addClause('where', 'title', $postTitle[$value]);
         });
         $this->crud->addFilter([
            'name'  => 'content',
            'type'  => 'select2',
            'label' => 'content',
            'attribute' => 'content',
          ], function() {
                $postContent=Post::all()->pluck('content')->toArray();
                return $postContent;
          }, function($value) { // if the filter is active
                $postContent=Post::all()->pluck('content')->toArray();
                $this->crud->addClause('where', 'content', $postContent[$value]);
         });
         $this->crud->addFilter([
            'name'  => 'category_id',
            'type'  => 'select2',
            'label' => 'category',
            'attribute' => 'category',
          ], function () {
                $postCategory = Category::all()->pluck('name','id')->toArray();
                return $postCategory;
          }, function($value) { // if the filter is active
                $postCategory=Post::all()->pluck('category_id')->toArray();
                $this->crud->addClause('where', 'category_id',$value);
         });
         $this->crud->addFilter([
            'name'  => 'post_by',
            'type'  => 'select2',
            'label' => 'post_by',
            'attribute' => 'post_by',
          ],
          function() {
                $postBy=Post::all()->pluck('post_by')->toArray();
                return $postBy;
          },
          function($value) {
                $postBy=Post::all()->pluck('post_by')->toArray();
                $this->crud->addClause('where', 'post_by', $postBy[$value]);
         });

        
    }

    /**
     * Define what happens when the Create operation is loaded.
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PostRequest::class);
        CRUD::addFields([
            [
                'name' => 'title',
                'label' => 'Title',
                'tab'=>'post field'
            ],
            [
                'name' => 'content',
                'label' => 'Content',
                'type'=>'tinymce',
                'tab'=>'post field'
            ],
            [
                'name' => 'post_by',
                'type'=>'hidden',
                'label' => 'post_by',
                'tab'=>'post field',
                'default'=>backpack_user()->id,
            ],
            [
                'name' => 'category_id',
                'label' => 'Category_id',
                'tab'=>'post field'
            ],
            [
                'name' => 'tags',
                'label' => 'Tags',
                'tab'=>'post field'
            ],
            [
                'name' => 'gallery',
                'label' => "galleries",
                'type' => 'multi_images_upload',
                'sub-field' => 'url',
                'tab'=>'image'
            ],
            [
                'label' => "image_thimnail",
                'name' => "thumbnail",
                'type' => 'image',
                'crop' => true,
                'disk' => 'public',
                'upload'    => true,
                'temporary' => 10,
                'tab'=>'image'
            ]
        ]);
    }
    /**
     * Define what happens when the Update operation is loaded.
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store() {
        $res = $this->TraitStore();
        $entry = $this->crud->getCurrentEntry();
        $this->base64MorphManyFiles('gallery', $entry);
        return $res;
    }

    public function getPost()
    {
        $data=[
            'posts' => Post::orderBy('id','desc')->with('user','category')->paginate(20),
            'categories' => Category::paginate(15),
            'ads' => Ads::paginate(1),
        ];
        return view('index',$data);
    }

    public function getPostById($id)
    {
        $posts = Post::where('id', $id)->with('galleries','category','user','tags')->get();
        $post_category_id = $posts[0]->category->id;
        $related_info=Post::where('category_id',$post_category_id)->paginate(10);
        $categories = Category::paginate(15);
        $ads=Ads::paginate(1);
        
        $data=[
            'posts' => $posts,
            'related_info' => $related_info,
            'categories' => $categories,
            'ads' => $ads,

        ];
        return view('pages.info', $data);
    }


    protected function bulkDelete(PostRequest $request)
    {
        Post::destroy($request->entries);
        return $request->entries;
    }

    public function increaseViewer($id){
        Post::find($id)->increment('viewer', 1);
    }

}
