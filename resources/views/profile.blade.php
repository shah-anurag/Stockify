@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php //echo $user?>
        <profile-component class="col-md-12" userid="{{Auth::id()}}" userdetails="{{$user}}"></profile-component>
    </div>
</div>
@endsection
