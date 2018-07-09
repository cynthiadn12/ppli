@extends('flocation-mgmt.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Location</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('flocation-management.update', ['id' => $flocation->id]) }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group{{ $errors->has('loc_lvl1') ? ' has-error' : '' }}">
                                <label for="loc_lvl1" class="col-md-4 control-label">Location Name</label>

                                <div class="col-md-6">
                                    <input id="loc_lvl1" type="text" class="form-control" name="loc_lvl1" value="{{ $flocation->loc_lvl1 }}" required autofocus>

                                    @if ($errors->has('loc_lvl1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loc_lvl1') }}</strong>
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
