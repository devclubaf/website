@extends('layouts.app')

@section('style')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
  <form class = "col-md-4 form" action="{{action('HomeController@update')}}" method="post">
  	{!! csrf_field() !!}
  	<input type="hidden" name="token" value="{{ $token }}" placeholder="">
    <div class="form-group row">
      <input type="text" class="form-control" placeholder="Location" name = "location">
    </div>
    <div class="form-group row">
      <input type="text" class="form-control datepicker" placeholder="Date of Birth" name = "dob">
    </div>
    <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-legend col-sm-2">Gender</legend>
        <div class="col-sm-10">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gender" value="male" checked>
              Male
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gender" value="female">
              Female
            </label>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="form-group row">
      <button type="submit" class="btn btn-primary btn-block">Sign in</button>
    </div>
  </form>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
			autoclose: true,
			format:  "yyyy-mm-dd",
		});
</script>
@endpush
