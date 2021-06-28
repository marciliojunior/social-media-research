@php
if(isset($javascript_vars) && isset($javascript_vars['social_networks'])){
    $database_is_filled = sizeof($javascript_vars['social_networks']);
}
else
    $database_is_filled = false;
@endphp

<div class="configButton" data-toggle="modal" data-target=".config">
    <button id="configButton" type="button" class="btn btn-primary">
        <i class="bi bi-gear-fill"></i>
    </button>
</div>

<div class="modal fade config" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Database configuration</h5>
                @if($database_is_filled)
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endif
            </div>
            <div class="modal-body">
                @if(!$database_is_filled)
                    <div class="alert alert-danger" role="alert">
                        <strong>Attention! There is no information on database.</strong>
                    </div>
                @endif

                <div class="alert alert-info" role="alert">
                    Fill the fields below to populate the database. <strong>Warning!</strong> Values that are too high can be time-consuming for data generation.
                    <strong>All current data will be lost</strong>
                </div>
                <form id="formSeeder">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="numberOfPersons">Number of persons</label>
                            <input type="number" class="form-control" id="numberOfPersons" name="numberOfPersons" placeholder="Numeric value" value="{{ config('seeder.persons') }}">
                            <small id="numberOfPersons" class="form-text text-muted">Number of people registered in the database</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="maximumAccounts">Maximum accounts per person</label>
                            <input type="number" class="form-control" id="maximumAccounts" name="maximumAccounts" placeholder="Numeric value" value="{{ config('seeder.accounts') }}">
                            <small id="maximumAccounts" class="form-text text-muted">Randomly between 1 and the filled value</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="maximumPosts">Maximum posts per person</label>
                            <input type="number" class="form-control" id="maximumPosts" name="maximumPosts" placeholder="Numeric value" value="{{ config('seeder.maxposts') }}">
                            <small id="maximumPosts" class="form-text text-muted">Randomly between 1 and the filled value</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="numberOfLists">Number of lists</label>
                            <input type="number" class="form-control" id="numberOfLists" name="numberOfLists" placeholder="Numeric value" value="{{ config('seeder.lists') }}">
                            <small id="numberOfLists" class="form-text text-muted">Total number of registered lists</small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btSeedDatabase" type="button" class="btn btn-success">Seed Database</button>
                @if($database_is_filled)
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @endif
            </div>
        </div>
    </div>
</div>
