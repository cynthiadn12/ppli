@extends('slocation-mgmt.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Second Location</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('slocation-management.update', ['id' => $slocation->id]) }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group{{ $errors->has('loc_name') ? ' has-error' : '' }}">
                                <label for="loc_name" class="col-md-4 control-label">Location Name</label>

                                <div class="col-md-6">
                                    <input id="loc_name" type="text" class="form-control" name="loc_name" value="{{ $slocation->loc_name }}" required autofocus>

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
                                            <option value="{{$flocation->id}}" {{$flocation->id == $slocation->loc_lvl1_id ? 'selected' : ''}}>{{$flocation->loc_lvl1}}</option>
                                        @endforeach
                                    </select>
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
