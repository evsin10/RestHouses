<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HouseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class HouseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class HouseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private function getFieldsData($show = FALSE) {
        return [
            [
                'name'=> 'name',
                'label' => 'Name',
                'type'=> 'text'
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => ($show ? "textarea": 'ckeditor'),
            ],
            [
                'name' => 'roomcount',
                'label' => 'Rooms',
                'type' => 'text',
            ],
            [
                'name' => 'bedcount',
                'label' => 'Beds',
                'type' => 'text',
            ],
            [    // Select = 1-n relationship
                'label'     => "Location",
                'type'      => 'select',
                'name'      => 'location_id',//The foreign key column.
                'entity'    => 'location', // the method that defines the relationship in your Model
                'model'     => "App\Models\Location", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'default'   => 2,// on create&update, do you need to add/delete pivot table entries?
            ],
            [    // Select = 1-n relationship
                'label'     => "Type",
                'type'      => 'select',
                'name'      => 'type_id',//The foreign key column.
                'entity'    => 'type', // the method that defines the relationship in your Model
                'model'     => "App\Models\Type", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'default'   => 2,// on create&update, do you need to add/delete pivot table entries?
            ],
            [
                'label' => "House Image",
                'name' => "image",
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 0, // omit or set to 0 to allow any aspect ratio
            ]
            ];
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\House::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/house');
        CRUD::setEntityNameStrings('house', 'houses');

        $this->crud->addFields($this->getFieldsData());
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(TRUE));

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(HouseRequest::class);

        CRUD::setFromDb(); // fields

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
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(TRUE));
    }
}
