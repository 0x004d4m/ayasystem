<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FinancialStatementRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class FinancialStatementCrudController extends CrudController
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
        CRUD::setModel(\App\Models\FinancialStatement::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/financial-statement');
        CRUD::setEntityNameStrings('financial statement', 'financial statements');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();

        $this->crud->addColumn('bank_card_id', [
            'label' => "Bank Card",
            'type' => "select",
            'name' => 'bank_card_id',
            'entity' => 'bankCard',
            'attribute' => "iban_number",
            'model' => 'App\Models\BankCard'
        ]);
        $this->crud->setColumnDetails('bank_card_id', [
            'label' => "Bank Card",
            'type' => "select",
            'name' => 'bank_card_id',
            'entity' => 'bankCard',
            'attribute' => "iban_number",
            'model' => 'App\Models\BankCard'
        ]);

        $this->crud->setColumnDetails('proof', [
            'name'   => 'proof',
            'type'   => 'link',
            'label'  => 'Proof',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(FinancialStatementRequest::class);
        CRUD::setFromDb();
        $this->crud->addField([
            'label' => "Bank Card",
            'type' => "select",
            'name' => 'bank_card_id',
            'entity' => 'bankCard',
            'attribute' => "iban_number",
            'model' => 'App\Models\BankCard'
        ]);
        $this->crud->field([
            'name'   => 'proof',
            'type'   => 'upload',
            'label'  => 'Proof',
            'withFiles' => true
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
