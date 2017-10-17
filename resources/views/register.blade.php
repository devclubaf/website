@extends('layouts.app')
@section('style')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="row no-padding">
    <div class = "col-3 form">
        <div class="col-md-12 image"><a href="/"><img src="{{ asset('images/logo.png') }}" alt=""></a></div>
        <form action="{{ route('update', $token) }}" method="POST">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <div class="alert alert-warning" role="alert"> One Step More! </div>
            <input type="hidden" name="token" value="{{ $token }}" placeholder="">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search Location" id = "search-location">
                <small class="form-text text-info"> Type your location and select from google place autocomplete. </small>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Map Coordinates" name = "location" id = "location">
                <small class="form-text text-info"> To get the exact location, move the marker and click on the map </small>
            </div>
            <div class="form-group"> <input type="text" class="form-control datepicker" placeholder="Date of Birth" name = "dob"> </div>
            <fieldset class="form-group">
                <div class="col-md-12">
                    <legend class="col-form-legend col-sm-3">Gender</legend>
                    <div class="col-sm-12">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label"> <input class="form-check-input" type="radio" name="gender" value="male" checked> Male </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label"> <input class="form-check-input" type="radio" name="gender" value="female"> Female </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group"> <button type="submit" class="btn btn-primary btn-block">Join</button> </div>
        </form>
    </div>
    <div class="col-9 no-padding"> <div id="register-map"></div> </div>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"> </script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDgIdV7w8h18k8E0TtZwjIlYjFi8cCBX2Y&am"> </script>
<script src="{{ asset('js/register.js') }}"></script>
<script>
    $(function(){ initMap(); })
</script>
@endpush
@section('validator')
    {!! JsValidator::formRequest('App\Http\Requests\RegisterFormRequest') !!}
@endsection