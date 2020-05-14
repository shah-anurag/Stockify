@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php //echo $user?>
        <profile-component user="{{$user}}"></profile-component>
    </div>
</div>
@endsection
