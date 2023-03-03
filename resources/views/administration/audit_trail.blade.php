@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Audit Trail</h5>
                </div>
                <div class="card-body">
                    <div class="row py-3">
                        <div class="col">
                            <table id="user_table" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>                                    
                                    <th></th>
                                    <th>Is Active</th>
                                    <th width="110px"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
