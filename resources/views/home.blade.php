@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <dashboard-component class="col-md-12" user="{{Auth::id()}}" token="{{csrf_token()}}"></dashboard-component>
    </div>
</div>
@endsection