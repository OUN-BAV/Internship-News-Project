<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\App\Models\Ads::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/ads');
        $this->crud->setEntityNameStrings('ads', 'ads');
    }

    /**
     * Define what happens when the List operation is loaded.
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->column('title')->type('string');
        $this->crud->addColumn(
            [
                'name'     => 'image',
                'label'    => 'image',
                'type'     => 'closure',
                'function' => function ($entry) {
                    if($entry->image == null){
                        return "<a href='".asset('uploads/folder_1/folder_2/images.png')."' data-lightbox='roadtrip'><img style='width:30px;' src='" . asset('uploads/folder_1/folder_2/images.png') . "'></img></a>";
                    }else{
                        return "<a href='".asset($entry->image)."' data-lightbox='roadtrip' ><img style='width:30px;' src='" . asset($entry->image) . "'></img></a>";
                    }
                },
                'escaped' => false
            ],
        );
        $this->crud->column('expire_at')->type('date');
        $this->crud->column('active')->type('string');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AdsRequest::class);

        $this->crud->field('title')->type('text');
        $this->crud->addField([
            // DateTime
            'name'  => 'expire_at',
            'label' => 'Expire_date',
            'type'  => 'datetime_picker',
            // optional:
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm',
                'language' => 'pt',
                'tooltips' => [ //use this to translate the tooltips in the field
                        'today' => 'Hoje',
                        'selectDate' => 'Selecione a data',
                        // available tooltips: today, clear, close, selectMonth, prevMonth, nextMonth, selectYear, prevYear, nextYear, selectDecade, prevDecade, nextDecade, prevCentury, nextCentury, pickHour, incrementHour, decrementHour, pickMinute, incrementMinute, decrementMinute, pickSecond, incrementSecond, decrementSecond, togglePeriod, selectTime, selectDate
                ]
            ],
            'allows_null' => true,
            // 'default' => '2017-05-12 11:59:59',
        ],);
        $this->crud->field('active')->type('boolean');
        $this->crud->addField([
            'label' => "Ads Image",
            'name' => "image",
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // o accessor function
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
}
