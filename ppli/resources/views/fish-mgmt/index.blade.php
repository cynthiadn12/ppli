@extends('fish-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <a class="btn btn-success" href="{{ route('fish-management.create') }}"><i class="fa fa-plus-circle">New Fish</i></a>
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
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Fish Name</th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Picture</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Type</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Size</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Description</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($fishes as $fish)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $fish->fish_name }}</td>
                                        <td>{{ $fish->pict }}</td>
                                        <td class="hidden-xs">{{ $fish->type }}</td>
                                        <td class="hidden-xs">{{ $fish->size }}</td>
                                        <td class="hidden-xs">{{ $fish->description }}</td>
                                        <td>
                                            <form class="row" method="POST" action="{{ route('fish-management.edit', ['id' => $fish->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">&nbsp&nbsp&nbsp
                                                <a href="{{ route('fish-management.edit', ['id' => $fish->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
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
                                    <th width="10%" rowspan="1" colspan="1">Fish Name</th>
                                    <th width="20%" rowspan="1" colspan="1">Picture</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Type</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Size</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Description</th>
                                    <th rowspan="1" colspan="2">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($fishes)}} of {{count($fishes)}} entries</div>
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