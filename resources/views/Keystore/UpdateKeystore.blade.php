@extends('layouts.app')
@section('script')
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({format: 'dd/mm/yyyy'});
  });
  $(document).ready(function(){
    var count =0;
    
    $('#imagclick').click(function(){
      if(count<5){
      var html = "<div style='padding-top:2em;' class=\"form-group{{ $errors->has('image[]') ? ' has-error' : '' }}\">";
          html += '<div  class="col-md-12">';
          html += '<input id="image_'+count+"\""+ 'type="file" class="form-control" name="image[]"'+'>';
          html +="@if ($errors->has('image[]'))";
          html += '<span class="help-block">';
          html+="<strong>{{ $errors->first('image[]') }}</strong>";
          html+="</span>";
          html+="@endif";
          html+="</div>  </div> </div>";
          count++;
          $("#imagepanel").append(html); 
        }
    });
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
                <form  role="form" method="POST" action='/keystore/update/{{$keystore->id}}' enctype="multipart/form-data" >
                        {{ csrf_field() }}
                   <div class="row" style="border-bottom: solid">
                   
                <div class="col-md-2" style="padding-left: 1em"  >
                @if($keystore->logo != null)
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
                <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                        <div  class="col-md-12">
                             <input id="logo" type="file" class="form-control" name="logo">

                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>

                <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label">Shop Arabic Name</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" name="shop_ar_name"  class="form-control">
                    </div>
                    <div class="col-md-2" style="padding-top: 0.5em"  >
                     <label class="control-label">Address</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" name="address" class="form-control" >
                    </div>
                </div>


                    <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
                     <label class="control-label">Shop English Name</label>
                        </div>
                    <div class="col-md-3">
                    <input  type="text" name="shop_en_name"  class="form-control" >
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

                <div class="row" style=" border-bottom: solid; padding-bottom: 1em; padding-top: 0.5em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em"  >
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
                @if(Auth::user()->keystore->first() != null)
                @if(Auth::user()->keystore->typeOfService=="Super")
                @if(Auth::user()->keystore->images->first() == null)
                <div class="row"   padding-top: 1em" >
                
                    <<div class="col-md-12"  style="border-bottom: solid; padding-bottom: 2em; padding-left: 1em; padding-top: 0.5em;">
                      <label class="control-label">Images</label>
                    </div>
                </div>
                <div id="imagclick" class="col-md-2" >
                <button type="button" style="border-style: solid;" class="btn btn-primary">Add an Image</button>
                </div>
                <div id="imagepanel" class="row" style=" padding-top: 1em" >
                
                </div>
                <div class="row" style="padding-top:  2em; padding-left: 40em">
                 <button class="btn btn-primary" type="submit" >Update</button>
                </div>
                @else
                <div class="row" style=" padding-top: 1em" >
                    <div class="col-md-2" style="padding-left: 1em; padding-top: 0.5em" >
                     <label class="control-label">Images</label>
                    </div>
                </div>
                 @foreach (Auth::user()->keystore->images as $images)
                   <div class="col-md-3" style="padding-left: 2em;padding-bottom: 2em">
                    <img width="115px"  height="115px" src="/public/images/{{Auth::user()->mobile}}/uploads/{{$images->image_name}}">
                    <input  type="file" class="form-control" name="images[]">
                    <input type="hidden" name="images_id[]" value="{{$images->id}}">
                    </div>
                  @endforeach

                  @if(Auth::user()->keystore->images->count() < 5 )
                  @for($i=Auth::user()->keystore->images->count(); $i < 5; $i++) 
                  <div id="imagepanel" class="row" style=" padding-top: 1em" >
                  <input type="file" class="form-control" name="image[]">
                  </div>
                  @endfor 
                @endif
                <div class="row" style="padding-top:  2em; padding-left: 45em">
                 <button class="btn btn-primary" type="submit" >Update</button>
                </div>
                @endif
                @endif
                @endif
                
                </form>

                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
