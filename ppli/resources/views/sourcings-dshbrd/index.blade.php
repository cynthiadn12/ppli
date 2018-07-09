@extends('sourcings-dshbrd.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <a class="btn btn-success" href="{{ route('sourcing-dashboard.create') }}"><i class="fa fa-plus-circle">New Sourcing</i></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>

                <body>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-striped table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>First Location</th>
                                        <th>Second Location</th>
                                        <th>Vendor</th>
                                        <th>Fish</th>
                                        <th>Quantity</th>
                                        <th>Measurement</th>
                                        <th>Price</th>
                                        <th>Valid Until</th>
                                    </tr>
                                </thead>
                                @foreach($sourcings as $item)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{ $item->loc_lvl1_name }}</td>
                                    <td class="sorting_1">{{ $item->loc_lvl2_name }}</td>
                                    <td class="sorting_1">{{ $item->vendor_name }}</td>
                                    <td class="sorting_1">{{ $item->fish_name }}</td>
                                    <td class="sorting_1">{{ $item->qty }}</td>
                                    <td class="sorting_1">{{ $item->measurement_name }}</td>
                                    <td class="sorting_1">{{ $item->price }}</td>
                                    <td class="sorting_1">{{ $item->valid_until }}</td>
                                    <td>
                                        <form class="row" method="POST" action="{{ route('sourcing-dashboard.destroy', ['id' => $item->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">&nbsp&nbsp&nbsp
                                            <a href="{{ route('purchase-proposal.create', ['id' => $item->id]) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                            <a href="{{ route('sourcing-dashboard.edit', ['id' => $item->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            {{--@if ($user->name != Auth::user()->name)--}}
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            {{--@endif--}}
                                        </form>
                                    </td>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>                    
                </div>

                 <script>
                 $(document).ready(function(){
                    $('#table').DataTable();
                 });
                 </script>

                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($sourcings)}} of {{count($sourcings)}} entries</div>
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
</body>

@endsection