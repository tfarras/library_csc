@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-6">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-book-open"></i>
                    </div>
                    <div class="mr-5">{{$books->count()}} books registered</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('books.listview')}}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-6">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-user"></i>
                    </div>
                    <div class="mr-5">{{$beneficiars->count()}} beneficiaries registered</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('beneficiaries.listview')}}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>

    </div>


@endsection

@section('scripts')
    <script src="{{asset('/vendor/chart.js/Chart.min.js')}}"></script>
@endsection