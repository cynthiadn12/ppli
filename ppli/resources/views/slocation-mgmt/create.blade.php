@extends('slocation-mgmt.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new Location</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('slocation-management.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('loc_name') ? ' has-error' : '' }}">
                                <label for="loc_name" class="col-md-4 control-label">Location Name</label>

                                <div class="col-md-6">
                                    <input id="loc_name" type="text" class="form-control" name="loc_name" value="{{ old('loc_name') }}" required autofocus>

                                    @if ($errors->has('loc_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loc_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">First Location</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="loc_lvl1_id">
                                        @foreach ($flocations as $flocation)
                                            <option value="{{$flocation->id}}">{{$flocation->loc_lvl1}}</option>
                                        @endforeach
                                    </select>
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
