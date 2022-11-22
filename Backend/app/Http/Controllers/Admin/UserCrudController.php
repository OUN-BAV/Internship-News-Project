<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Imports\UsersImport;
// use Maatwebsite\Excel\Excel;
use App\Http\Requests\UserRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        $this->crud->setModel(\App\Models\User::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
        
    }
    
    /**
     * Define what happens when the List operation is loaded.
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // button ---------

        $this->crud->enableExportButtons();
        $this->crud->addButtonFromView('top', 'bulk_delete', 'bulk_delete', 'start');
        $this->crud->addButtonFromView('top', 'import', 'import', 'end');
        $this->crud->enableBulkActions();

        // filter ---------

        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'select2',
            'label' => 'name',
            'attribute' => 'name',
          ], function() {
                $user=\App\Models\User::all()->pluck('name')->toArray();
                return $user;
          }, function($value) { // if the filter is active
                $user=\App\Models\User::all()->pluck('name')->toArray();
                $this->crud->addClause('where', 'name', $user[$value]);
         });
         $this->crud->addFilter([
            'name'  => 'email',
            'type'  => 'select2',
            'label' => 'email',
            'attribute' => 'email',
          ], function() {
                $user=\App\Models\User::all()->pluck('email')->toArray();
                return $user;
          }, function($value) { // if the filter is active
                $user=\App\Models\User::all()->pluck('email')->toArray();
                $this->crud->addClause('where', 'email', $user[$value]);
         });
         $this->crud->addFilter([
            'name'  => 'phone',
            'type'  => 'select2',
            'label' => 'phone',
            'attribute' => 'phone',
          ], function() {
                $user=\App\Models\User::all()->pluck('phone')->toArray();
                return $user;
          }, function($value) {
                $user=\App\Models\User::all()->pluck('phone')->toArray();
                $this->crud->addClause('where', 'phone', $user[$value]);
         });

         // column table ---------

       
         $this->crud->addColumn(
             [
                 'name'     => 'profile',
                 'label'    => 'profile',
                 'type'     => 'closure',
                 'function' => function ($entry) {
                     if($entry->profile == null){
                         return "<a href='".asset('uploads/folder_1/folder_2/images.png')."' data-lightbox='.$entry->id.'><img style='width:50px;' class='img-thumbnail rounded-circle' src='" . asset('uploads/folder_1/folder_2/images.png') . "'></img></a>";
                     }else{
                         return "<a href='".asset($entry->profile)."' data-lightbox='.$entry->id.' ><img style='width:50px;' class='img-thumbnail rounded-circle' src='" . asset($entry->profile) . "'></img></a>";
                     }
                 },
                 'escaped' => false
             ],
         );
        $this->crud->column('name');
        $this->crud->column('email');
        $this->crud->column('phone')->type('tel');
        $this->crud->column('address');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        $this->crud->field('name');
        $this->crud->field('email');
        $this->crud->field('password');
        $this->crud->addField([
            'name'          => 'address',
            'label'         => 'Address',
            'type'          => 'address',
        ]);
        $this->crud->field('phone');
        $this->crud->addField([
            'label' => "user profile",
            'name' => "profile",
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 1,
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

    protected function bulkDelete(UserRequest $request){
        User::destroy($request->entries);
        return $request->entries;
    }

    protected function profileUpdate(Request $request){
        dd($request);
    }
    
    public function importToDb()
    {
        if (request()->hasFile('file')) {
           Excel::import(new UsersImport, request()->file);
            return response()->json([
                'success' => true,
                'message' => "Import customer successfully."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "File does not exist"
            ]);
        }
    }
}
