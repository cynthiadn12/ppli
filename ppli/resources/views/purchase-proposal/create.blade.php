@extends('purchase-proposal.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Purchase Proposal</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('purchase-proposal.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                                <label for="qty" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-6">
                                    <input id="qty" type="text" class="form-control" name="qty" value="{{ old('qty') }}" required autofocus>

                                    @if ($errors->has('qty'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('qty') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Measurement</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="id_measurement">
                                        @foreach ($measurements as $measurement)
                                            <option value="{{$measurement->id}}">{{$measurement->measurement_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="qty" class="col-md-4 control-label">Status</label>

                                <div class="col-md-6">
                                    <input id="status" type="text" class="form-control" name="status" value="{{ old('status') }}" required autofocus>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
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
