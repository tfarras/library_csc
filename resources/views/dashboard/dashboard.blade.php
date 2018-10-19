@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>


@endsection

@section('scripts')
    <script src="{{asset('/vendor/chart.js/Chart.min.js')}}"></script>
@endsection