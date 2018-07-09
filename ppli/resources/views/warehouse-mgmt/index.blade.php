@extends('warehouse-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <a class="btn btn-success" href="{{ route('warehouse-management.create') }}"><i class="fa fa-plus-circle">New Warehouse</i></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>

                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-striped table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Warehouse Name</th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Location</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Latitude</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Longitude</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Capacity</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($warehouses as $warehouse)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $warehouse->name }}</td>
                                        <td>{{ $warehouse->location }}</td>
                                        <td class="hidden-xs">{{ $warehouse->latitude }}</td>
                                        <td class="hidden-xs">{{ $warehouse->longitude }}</td>
                                        <td class="hidden-xs">{{ $warehouse->capacity }}</td>
                                        <td>
                                            <form class="row" method="POST" action="{{ route('warehouse-management.destroy', ['id' => $warehouse->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">&nbsp&nbsp&nbsp
                                                <a href="{{ route('warehouse-management.edit', ['id' => $warehouse->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                {{--@if ($user->name != Auth::user()->name)--}}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                {{--@endif--}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th width="10%" rowspan="1" colspan="1">Warehouse Name</th>
                                    <th width="20%" rowspan="1" colspan="1">Location</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Latitude</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Longitude</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Capacity</th>
                                    <th rowspan="1" colspan="2">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($warehouses)}} of {{count($warehouses)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
