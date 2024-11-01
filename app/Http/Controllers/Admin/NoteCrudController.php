<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NoteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class NoteCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Note::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/note');
        CRUD::setEntityNameStrings('note', 'notes');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();

        CRUD::removeColumn('note');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(NoteRequest::class);
        CRUD::setFromDb();

        CRUD::field('note')->type('CKEditor');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::addColumn([
            'name' => 'note',           // the database column
            'label' => 'Note',          // label to display
            'type' => 'custom_html',       // allows custom HTML rendering
            'value' => function ($entry) {
                return $entry->note;    // output raw HTML with {!! !!} equivalent
            },
        ]);
    }
}
