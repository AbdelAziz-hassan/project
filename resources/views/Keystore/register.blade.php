@extends('layouts.app')

@section('script')
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({format: 'dd/mm/yyyy'});
  });

</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/keystore/register') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shop_en_name') ? ' has-error' : '' }}">
                            <label for="shop_en_name" class="col-md-4 control-label">shop en name</label>

                            <div class="col-md-6">
                                <input id="shop_en_name" type="text" class="form-control" name="shop_en_name" value="{{ old('shop_en_name') }}">

                                @if ($errors->has('shop_en_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shop_en_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('shop_ar_name') ? ' has-error' : '' }}">
                            <label for="shop_ar_name" class="col-md-4 control-label">shop Ar Name</label>

                            <div class="col-md-6">
                                <input id="shop_ar_name" type="text" class="form-control" name="shop_ar_name" value="{{ old('shop_ar_name') }}">

                                @if ($errors->has('shop_ar_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shop_ar_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('typeOfService') ? ' has-error' : '' }}">
                            <label for="typeOfService" class="col-md-4 control-label">Type Of Service</label>

                            <div class="col-md-6">
                            <select class="form-control m-bot15" name="typeOfService">
                             <option value="Super">Super</option>
                             <option value="Normal" selected="selected">Normal</option>
                             </select>

                                @if ($errors->has('typeOfService'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('typeOfService') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('n_w_hours') ? ' has-error' : '' }}">
                            <label for="n_w_hours" class="col-md-4 control-label">No Of work hours</label>

                            <div class="col-md-6">
                                <input id="n_w_hours" type="text" class="form-control" name="n_w_hours" value="{{ old('n_w_hours') }}">

                                @if ($errors->has('n_w_hours'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('n_w_hours') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                         <div class="form-group{{ $errors->has('activeStatues') ? ' has-error' : '' }}">
                            <label for="activeStatues" class="col-md-4 control-label">Active Statues</label>

                            <div class="col-md-6">
                              <select class="form-control m-bot15" name="activeStatues">
                                    <option value="0">Not Active</option>
                                    <option value="1"  selected ="selected">Active</option>
                               </select>
                                @if ($errors->has('activeStatues'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activeStatues') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                       
                        <div class="form-group{{ $errors->has('sDate') ? ' has-error' : '' }}">
                        <label for="sDate" class="col-md-4 control-label">Start Date</label>
                        <div style="padding-left: 1em" class="col-md-6 input-group date" data-provide="datepicker">
                             <input type="text" class="form-control" name="sDate">
                             <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                             </div>
                        </div>
                         @if ($errors->has('sDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sDate') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                       
                       <div class="form-group{{ $errors->has('eDate') ? ' has-error' : '' }}">
                        <label for="eDate" class="col-md-4 control-label">End Date</label>
                        <div style="padding-left: 1em" class="col-md-6  input-group date" data-provide="datepicker">
                             <input type="text"  class="form-control" name="eDate">
                             <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                             </div>
                        </div>
                         @if ($errors->has('eDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('eDate') }}</strong>
                                    </span>
                                @endif
                        </div>
                        


                         <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label for="logo" class="col-md-4 control-label">logo</label>
                        <div  class="col-md-6">
                             <input id="logo" type="file" class="form-control" name="logo">

                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
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
