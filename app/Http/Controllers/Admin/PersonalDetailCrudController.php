<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonalDetailRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PersonalDetailCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (!backpack_user()->can('View')) {
            abort(403, 'Access denied');
        }

        if (!backpack_user()->can('Edit')) {
            $this->crud->denyAccess(['create', 'delete', 'update']);
        }
        CRUD::setModel(\App\Models\PersonalDetail::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/personal-detail');
        CRUD::setEntityNameStrings('personal detail', 'personal details');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();

        $this->crud->addColumn('user_id', [
            'label' => "User",
            'type' => "select",
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => "name",
            'model' => 'App\Models\User'
        ]);
        $this->crud->setColumnDetails('user_id', [
            'label' => "User",
            'type' => "select",
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => "name",
            'model' => 'App\Models\User'
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(PersonalDetailRequest::class);
        CRUD::setFromDb();
        $this->crud->addField([
            'label' => "User",
            'type' => "select",
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => "name",
            'model' => 'App\Models\User'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
}