<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class FinishedTaskCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (!backpack_user()->can('View')) {
            abort(403, 'Access denied');
        }

        if (!backpack_user()->can('Edit')) {
            $this->crud->denyAccess(['create', 'delete', 'update']);
        }
        CRUD::setModel(\App\Models\Task::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/finished-task');
        CRUD::setEntityNameStrings('finished task', 'finished tasks');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();
        $this->crud->setColumnDetails('name', [
            'label' => "Name",
            'type' => "url",
            'name' => 'name',
        ]);

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

        $this->crud->addClause('where', 'is_finished', true);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
}
