@extends('measurement-mgmt.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new Measurement</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('measurement-management.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('measurement_name') ? ' has-error' : '' }}">
                                <label for="measurement_name" class="col-md-4 control-label">Measurement Name</label>

                                <div class="col-md-6">
                                    <input id="measurement_name" type="text" class="form-control" name="measurement_name" value="{{ old('measurement_name') }}" required autofocus>

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
                                        Create
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
