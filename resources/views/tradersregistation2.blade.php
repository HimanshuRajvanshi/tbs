@extends('home.layouts.app')

@section('css')
      <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
      </style>
@endsection

@section('content')

<div class="sort_form">
<div class="container-fluid">
<div class="container">
 <div class="my_car_2">
     <img src=" {{ asset('node_modules/img/reg_banner.jpg' ) }}" class="img-responsive" >
  </div>
</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        @include('layouts.errors')
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            <em>{!! session('flash_message') !!}</em>
          </div> 
        @endif
        <div class="card-body">
          <form action="{{ url('/traders_registation') }}" method="POST" id="tradersform">
            {!! csrf_field() !!}
            
            <div class="form-group row">
              <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Full Name :</label>
              <div class="col-sm-5">
                <input type="text" id="name" value="{{old('name')}}" name="name" class="form-control form-control-sm" placeholder="Enter Full Name" style="border-radius:0px;">
              </div>
            </div>
                    
            <div class="form-group row">
              <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Email :</label>
              <div class="col-sm-5">
                <input type="email"  name="email" value="{{old('email')}}" class="form-control form-control-sm" placeholder="Enter Email" style="border-radius:0px;">
              </div>
              <div class="col-sm-4"></div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Mobile Number :</label>
              <div class="col-sm-5">
                <input type="text" id="mobile" name="mobile" value="{{old('mobile')}}" class="form-control form-control-sm" placeholder="Enter Mobile Number" style="border-radius:0px;">
              </div>
              <div class="col-sm-4"></div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label"  style="padding-top:1px;">Do You Have Business ? :</label>
              <div class="col-sm-5">
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input chkPassPort" type="radio" onclick="isbuessiness(1)"  checked name="chkPassPort" value="1">
                  <label class="form-check-label" for="inline-radio3">YES</label>
                </div>
    
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input chkPassPort" type="radio" onclick="isbuessiness(0)" name="chkPassPort"  value="0" >
                  <label class="form-check-label" for="inline-radio3">NO</label>
                </div>
              </div>

              <div class="col-sm-4"></div>
            </div>

            <div class="card-header"  style="background:#F9F9F9;border-top:1px solid #c2cfd6;">Enter Your Business Information</div>
              <div class="card-body" >
                <div class="form-group row" id="business_name">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Business Name :</label>
                  <div class="col-sm-5">
                    <input type="text"  name="business_name" value="{{old('business_name')}}" class="form-control form-control-sm" placeholder="Enter Business Name" style="border-radius:0px;">
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>
                      
                <div class="form-group row" id="business_email">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Business Email :</label>
                  <div class="col-sm-5">
                    <input type="text"  name="business_email" value="{{old('business_email')}}" class="form-control form-control-sm" placeholder="Enter Email" style="border-radius:0px;" >
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>
            
                <div class="form-group row" id="business_cont_no">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Business Contact :</label>
                  <div class="col-sm-5">
                  <input type="text"  name="business_cont_no" value="{{old('business_count_no')}}" class="form-control form-control-sm" placeholder="Enter Business Number" style="border-radius:0px;" >
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>
            
                <div class="form-group row" id="website">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Website :</label>
                  <div class="col-sm-5">
                    <input type="text"  name="website" value="{{old('website')}}" class="form-control form-control-sm" placeholder="Enter Website" style="border-radius:0px;">
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Location :</label>
                  <div class="col-sm-5">
                    <input type="text" id="map_location" onFocus="geolocate()" name="location" placeholder="Enter Your Location" value="{{old('location')}}" class="form-control form-control-sm"  style="border-radius:0px;">
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>
            
                <div class="form-group row" id="full_address">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Full Address :</label>
                  <div class="col-sm-5">
                    <input type="text" name="full_address"  value="{{old('full_address')}}" class="form-control form-control-sm" placeholder="Enter Address" style="border-radius:0px;">
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>
            
                <div class="form-group row" id="serviceorproduct">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Type Of  Business ? :</label>
                  <div class="col-sm-5">
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" checked type="radio" name="types_of_business" value="1">
                      <label class="form-check-label" for="inline-radio3">PRODUCT</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" type="radio" name="types_of_business" value="2">
                      <label class="form-check-label" for="inline-radio3">SERVICE</label>
                    </div>
      
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" type="radio" name="types_of_business" value="3">
                      <label class="form-check-label" for="inline-radio3">BOTH</label>
                    </div>
                  </div>
                  <div class="col-sm-4"></div>
                </div>
            
                <div class="form-group row" id="categories">
                  <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Product Service Offered :</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="prod_or_serv_offe" name="prod_or_serv_offe">
                      <option value="">--Select Category--</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4"><small></small></div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label"  style="padding-top:1px;"><span style="color:red;margin-top:-2px;">* </span>Occupations:-</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="occupations" name="occupations" value="{{old('occupations')}}" placeholder="Enter Your Occupations">
                </div>
                <div class="col-sm-4"><small></small></div>
              </div> 

            </div>
            <center>  <input  type="button" value="Create My Account" class="btn btn-danger active" style="color:white;margin:10px 0px;" id="submitbtn"></center>
          </form>
        </div><!--end of card body-->
      </div>   
    </div>
  </div>
</div>
</div>

@endsection

@section('script')

<script>
  
  var url2  = "{{url('/traders_registation')}}"
    $(document).on('click', '#submitbtn', function(event){
      event.preventDefault();
      var datas = $( "form#tradersform" ).serialize();
      $.ajax({
        type: 'POST',
        url: url2,
        data: datas,
        dataType: "text",
        beforeSend: function() {
          $(".loader").show();
      },
        success: function(response) { 
            $("#submitbtn").attr("type", "submit");
            console.log(response);
            if(response == "success")
            {
              alert("Please Check Your Mail For Password");  
              location.reload();
            }else
            {
            alert("Error");
            }
        },
        error: function (textStatus, errorThrown) {
          console.log("Error In to Validate");
        },
        complete: function() {
          $(".loader").hide();
        },
      });
    })

</script>


<script>
    function isbuessiness(id){
      if(id == 1) {
        $('#business_name').show()
        $('#business_email').show()
        $('#business_cont_no').show()
        $('#website').show()
        $('#full_address').show()
        $('#serviceorproduct').show()
        $('#categories').show()
      }else{
        $('#business_name').hide()
        $('#business_email').hide()
        $('#business_cont_no').hide()
        $('#website').hide()
        $('#full_address').hide()
        $('#serviceorproduct').hide()
        $('#categories').hide()
      }
    }
</script>

   <script>
      var placeSearch, autocomplete;

      function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('map_location')),
            {types: ['geocode']});
             }
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFye6-D7TepBrDf4PhgTg0oEgJ9OFYzvY&libraries=places&callback=initAutocomplete"
        async defer></script>

@endsection
  