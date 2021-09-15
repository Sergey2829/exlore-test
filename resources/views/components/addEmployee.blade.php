<div class="table-title">
    <div class="row">
        <div class="col-sm-8"><h2>Employee <b>Records</b></h2></div>
        <div class="col-sm-4">
            <a href="{{ route('employees.create') }}">
             <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New Employee</button>
            </a>
        </div>
    </div>
    @includeWhen(isset($category), 'components.byCategory')
</div>
