@extends('measurement-mgmt.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Measurement</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('measurement-management.update', ['id' => $measurement->id]) }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group{{ $errors->has('measurement_name') ? ' has-error' : '' }}">
                                <label for="measurement_name" class="col-md-4 control-label">Measurement Name</label>

                                <div class="col-md-6">
                                    <input id="measurement_name" type="text" class="form-control" name="measurement_name" value="{{ $measurement->measurement_name }}" required autofocus>

                                    @if ($errors->has('measurement_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('measurement_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
