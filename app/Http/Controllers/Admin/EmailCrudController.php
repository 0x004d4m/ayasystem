<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmailRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmailCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        if (!backpack_user()->can('Edit')) {
            abort(403, 'Access denied');
        }
        CRUD::setModel(\App\Models\Email::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/email');
        CRUD::setEntityNameStrings('email', 'emails');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmailRequest::class);
        CRUD::setFromDb();
    }
}
