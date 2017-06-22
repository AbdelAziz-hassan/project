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
            <div class="panel panel-default" style="background-color: lightyellow">
                <div class="panel-heading">Update Keystore Data</div>
                <div class="panel-body">
                @if($keystore != null)
                    <form class="form-horizontal" role="form" method="POST" action='/keystore/upgrade/{{$keystore->id}}' enctype="multipart/form-data" >
                        {{ csrf_field() }}

                        <div class="row" style="border-style: solid; border-color: yellow ">
        							<div class="col-md-2"  >
      							
                       @if($keystore->logo != null)
                          <img width="115px"  height="115px" src="/public/images/{{$keystore->user->mobile}}/{{$keystore->logo}}">
                          @else
                              <img width="120px" height="120px" src="/public/images/default/def.jpg">
                          @endif
      							
        							</div>
                          <div class="col-md-3" style="color:blue">
                          <p>
                              <br>
                              <br>

                          </p>
                          <strong>Mobile: {{$keystore->user->mobile}}</strong><br>
                          <strong>Name: {{$keystore->shop_en_name}}</strong><br>
                          <strong>State: {{$keystore->activeStatues? "Active" : "Not Active"}}</strong>
                          <div class="row col-md-12" >
                            <strong >Begin: {{$keystore->begin_day}}</strong>
                            <strong >End: {{$keystore->end_day}}</strong>
                          </div>
                          </div>
                          <br></div>
         						   </div>
                       <div class="row" style="padding-left: 15em">
                       <div class="col-md-3"  style="color:blue">
                        <label for="activeState" class="control-label">Active State</label>
                        </div>
                        <div class="col-md-6"  style="color:blue">
                       <div class="form-group{{ $errors->has('activeState') ? ' has-error' : '' }}">

                            <select class="form-control m-bot15" name="activeState">
                             <option value="0"  {{$keystore->activeStatues == 0 ? 'selected ="selected"' : ""}}>Not Active</option>
                             <option value="1"  {{$keystore->activeStatues == 1 ? 'selected ="selected"' : ""}}}} >Active</option>
                             </select>

                                @if ($errors->has('activeState'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activeState') }}</strong>
                                    </span>
                                @endif
                        </div>
                       </div>
                       </div>
                       <div class="row" style="padding-left: 15em">
                       <div class="col-md-3"  style="color:blue">
                       <label for="sDate" class="control-label">Start Date</label>
                       </div>
                       <div class="col-md-6" style="color:blue">
                        <div class="form-group{{ $errors->has('sDate') ? ' has-error' : '' }}">
                        <div class="input-group date" data-provide="datepicker">
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
                        </div>
                        </div>
                        <br>
                        <div class="row" style="padding-left: 15em">
                       <div class="col-md-3"  style="color:blue">
                       <label for="eDate" class="control-label">End Date</label>
                       </div>
                       <div class="col-md-6" style="color:blue">
                       <div class="form-group{{ $errors->has('eDate') ? ' has-error' : '' }}">
                        <div class="input-group date" data-provide="datepicker">
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
                        </div>
                        </div>
                        <div class="row" style="padding-bottom: 2em; padding-top: 1em; padding-left: 40em">
                        <button  id="save" class="btn btn-primary" type="submit" value="Submit">Save</button>
                        </div>
                    </form>
                            

                    @else
                    <p>No Data</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
