<div class="table-title">
    <div class="row">
        <div class="col-sm-8"><h2>My <b>Records</b></h2></div>

        <div class="col-sm-4">
            <a href="{{ route('records.create') }}">
                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New Record</button>
            </a>
        </div>
    </div>
    @includeWhen(isset($category), 'components.byCategory')
</div>
