@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Books</a>
        </li>
        <li class="breadcrumb-item active">List View</li>
    </ol>

    @include('partials.messages4')


    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Import Book List
        </div>
        <div class="card-body" >
            <form action="{{route('books.listimport')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <input id="input-b1" name="file"  data-show-preview="false" type="file" class="file" accept=".xlsx,.xls">

                </div>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>


@endsection

@section('styles')
    <style>
        html{
            font-size: 1rem !important;
        }
    </style>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/themes/explorer-fas/theme.min.css" media="all" rel="stylesheet" type="text/css" />
@stop



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/themes/fa/theme.min.js"></script>
    <script>
        $("#input-id").fileinput({
            allowedFileExtensions: ["xlsx",'xls'],
            theme: "fa",
            maxFileCount: 1,
            'showUpload':false,
            showPreview:false,
        });
    </script>

@endsection