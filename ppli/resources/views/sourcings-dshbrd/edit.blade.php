@extends('sourcings-dshbrd.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update data</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('sourcing-dashboard.update', ['id' => $sourcing->id]) }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">First Location</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="id_loc_lvl1">
                                        @foreach ($flocations as $flocation)
                                            <option value="{{$flocation->id}}" {{$flocation->id == $sourcing->id_loc_lvl1 ? 'selected' : ''}}>{{$flocation->loc_lvl1}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Second Location</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="id_loc_lvl2">
                                        @foreach ($slocations as $slocation)
                                            <option value="{{$slocation->id}}" {{$slocation->id == $sourcing->id_loc_lvl2 ? 'selected' : ''}}>{{$slocation->loc_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Vendor</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="id_vendor">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{$vendor->id}}" {{$vendor->id == $sourcing->id_vendor ? 'selected' : ''}}>{{$vendor->comp_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Fish</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="id_fish">
                                        @foreach ($fishes as $fish)
                                            <option value="{{$fish->id}}" {{$fish->id == $sourcing->id_fish ? 'selected' : ''}}>{{$fish->fish_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                                <label for="qty" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-6">
                                    <input id="qty" type="text" class="form-control" name="qty" value="{{$sourcing->qty }}" required>

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
                                            <option value="{{$measurement->id}}" {{$measurement->id == $sourcing->id_measurement ? 'selected' : ''}}>{{$measurement->measurement_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" value="{{$sourcing->price }}" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('valid_until') ? ' has-error' : '' }}">
                                <label for="valid_until" class="col-md-4 control-label">Valid Until</label>

                                <div class="col-md-6">
                                    <input id="valid_until" type="date" class="form-control" name="valid_until" value="{{$sourcing->valid_until }}" required>

                                    @if ($errors->has('valid_until'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('valid_until') }}</strong>
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
