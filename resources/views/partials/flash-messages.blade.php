@if( Session::has("success") )
<div class="alert alert-success alert-block text-center alert-scroll alert-dismissable" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("success") }}
</div>
@endif
@if( Session::has("error") )
<div class="alert alert-danger alert-block text-center alert-scroll alert-dismissable" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {!! Session::get("error") !!}
    @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="py-1">{{$error}}</div>
          @endforeach
   @endif
</div>
@endif
