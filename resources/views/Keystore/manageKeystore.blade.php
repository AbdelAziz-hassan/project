@extends('layouts.app')

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){
   	$('.link').click(function(){
   		var id = this.id;
   		//alert(id);
   		$("#panel_"+id).slideToggle();
        //$('#panel_'+id).html(" ");
   		$.ajax({
                 url: 'keystore/'+id,
                 type: 'POST',
                 dataType: 'JSON',
                 data: {"_token": "{{ csrf_token() }}", id: id },

                 //$.get(url)
                 success: function(response)
                 {

                 	var html ='';
                 	for (item in response)
                 			{
                                var Active =  response[item].activeStatues? "Active" : "Not Active";
                 				html +='<div class="thumbnail" style="background-color:blue;">';
                                html +="<H4 align='center' style='color:white'><p>:"
                 				html += '<span>'+response[item].shop_ar_name+ '</span></p></H4>';
                                html +="<H5 align='center' style='color:white'><p>Address: "
                                html += '<span>'+response[item].address+ '</span></p></H5>';
                                html +="<H5 align='center' style='color:white'><p>Type Of Service:"
                                html += '<strong style="color:black">'+response[item].typeOfService+ '</strong></p></H5>';
                                html +="<H5 align='center' style='color:white'><p>Active: "
                                html += '<strong style="color:black">'+Active+ '</strong></p></H5>';
                                html +='<h1><a id='+response[item].id+' href = "/keystore/upgrade/' + response[item].id+'"';
                                html +='  class="btn btn-primary" style="width:150px;">'+"upgrade"+'</a></h1>';
                                html +="</div>";
                 				
                 			}

                 			$('#panel_'+id).html(html);
                 }

             });

	});
   });
</script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Managing Keystores</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/keystore/register') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}

                        <div class="row">
							@foreach($keystores as $k)
							<div class="col-md-3" >
							<div class="thumbnail" style="background-color:lightgray;">
                            @if($k->logo != null)
								<img width="150px" height="150px" src="/public/images/{{$k->user->mobile}}/{{$k->logo}}">
                            @else
                                <img width="150px" height="150px" src="/public/images/default/def.jpg">
                            @endif
								<h1><a  id={{$k->id}}  style="width:150px;" class="link btn btn-primary">{{$k->user->mobile}}</a></h1>
							</div>
                            <div id="panel_{{$k->id}}">
                                                     
                            </div>
							</div>
							@endforeach
							<div id="panel_{{$k->id}}">
                            </div>
						

 						 </div>
                         {{$keystores->links()}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
