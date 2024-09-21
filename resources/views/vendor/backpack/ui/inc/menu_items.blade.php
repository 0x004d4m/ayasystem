<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
@if (backpack_user()->can('Edit'))
    <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" />
@endif
<x-backpack::menu-item title="Personal details" icon="la la-briefcase" :link="backpack_url('personal-detail')" />
<x-backpack::menu-item title="Bank cards" icon="la la-credit-card" :link="backpack_url('bank-card')" />
<x-backpack::menu-item title="Tasks" icon="la la-tasks" :link="backpack_url('task')" />
<x-backpack::menu-item title="Financial statements" icon="la la-file-invoice-dollar" :link="backpack_url('financial-statement')" />
@if (backpack_user()->can('Edit'))
    <x-backpack::menu-item title="Emails" icon="la la-envelope" :link="backpack_url('email')" />
@endif
