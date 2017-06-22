@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body" style="background-color: lightyellow">
                @if(Auth::user()->keystore != null)
                <div class="row" style="border-bottom: solid">
                <div class="col-md-2" style="padding-left: 1em"  >
                    @if(Auth::user()->keystore->logo != null)
                <img width="115px"  height="115px" src="/public/images/{{Auth::user()->mobile}}/{{Auth::user()->keystore->logo}}">
                @else
                    <img width="120px" height="120px" src="/public/images/default/def.jpg">
                @endif
                </div>
                <div style="padding-bottom: 4em"></div>
                <div class="col-md-3 pad" style="color:blue">
                <strong>Mobile: {{Auth::user()->mobile}}</strong><br>
                <strong>Name: {{Auth::user()->keystore->shop_en_name}}</strong><br>
                <strong>State: {{Auth::user()->keystore->activeStatues? "Active" : "Not Active"}}</strong>
                </div>
                </div>

                <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label">Shop Arabic Name</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->shop_ar_name }}">
                    </div>
                    <div class="col-md-2" style="padding-top: 0.5em"  >
                     <label class="control-label">Address</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->address }}">
                    </div>
                </div>


                    <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label">Shop English Name</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->shop_en_name }}">
                    </div>
                    <div class="col-md-2" style="padding-top: 0.5em"  >
                     <label class="control-label">Type of Service</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->typeOfService }}">
                    </div>
                </div>
                 <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label">Begin Day</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->begin_day }}">
                    </div>
                    <div class="col-md-2" style="padding-top: 0.5em"  >
                     <label class="control-label">End Day</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->end_day }}">
                    </div>
                </div>

                <div class="row" style="border-bottom: solid; padding-top: 1em; padding-bottom: 1em" >                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label">Latitude</label>
                        </div>
                    <div class="col-md-3">
                    @if(Auth::user()->keystore->lat==0.0)
                    <input  type="text" disabled="true" class="form-control" value="Set it  on using our App on phones">
                    @else
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->lat }}">
                    @endif
                    </div>
                    <div class="col-md-2" style="padding-top: 0.5em"  >
                     <label class="control-label">Longitude</label>
                        </div>
                    <div class="col-md-3">
                    @if(Auth::user()->keystore->lng==0.0)
                    <input  type="text" disabled="true" class="form-control" value="Set it  on using our App on phones">
                    @else
                    <input  type="text" disabled="true" class="form-control" value="{{ Auth::user()->keystore->lng }}">
                    @endif
                    </div>
                </div>

                @if(Auth::user()->keystore->images->first() != null)
                <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-12"  style="border-bottom: solid; padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label" >Images</label>
                    </div>
                </div>
                <div class="row" style=" padding-top: 1em" >
                @foreach (Auth::user()->keystore->images as $images)
                   <div class="col-md-3" style="padding-left: 1em">

                    
                    <img width="115px"  height="115px" src="/public/images/{{Auth::user()->mobile}}/uploads/{{$images->image_name}}">
                    </div>
                                        @endforeach

                
                </div>
                @endif
                <div style="padding-top: 2em; padding-left: 60em">
                 <a class="btn btn-primary" href="{{ url('keystore/updateKeystore') }}">Update</a>
                </div>
                @else
                    You are logged in!
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
