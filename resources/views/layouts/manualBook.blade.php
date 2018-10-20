@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Books</a>
        </li>
        <li class="breadcrumb-item active">Adding New Book</li>
    </ol>

    @include('partials.messages4')

    <div class="card mb-3 col-md-4">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Add New Book
        </div>
        <div class="card-body" >
            <form action="{{route('books.manual.add.save')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" required name="name" placeholder="Book Name" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" required name="author" placeholder="Author" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  required name="edition" placeholder="Edition" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" required name="year" placeholder="Publication Year" />
                </div>
                <div class="form-group">
                    <select id="language" class="form-control"  required title="Language" name="language">
                        <option></option>
                        <option value="1">Romanian</option>
                        <option value="2">Russian</option>
                        <option value="3">English</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="category" class="form-control" required title="Category" name="category">
                        <option></option>
                        @foreach(\App\Category::all() as $item)
                            <option value="{{$item->id}}">{{$item->name}} ({{$item->code}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select id="status" class="form-control" required title="Status" name="status">
                        <option></option>
                        @foreach(\App\BookStatus::all() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function(){
            var table= $("#dataTable").DataTable({
                dom: 'Bfrtip',
                buttons: [ 'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' ],
                "lengthMenu": [
                    [20, 50, 100, -1],
                    [20, 50, 100, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 20,
                fixedHeader: true
            });

            var language = $("#language").select2({
                placeholder:'Language',
                width:'100%'
            });

            var category = $("#category").select2({
               placeholder:'Category',
               width:'100%'
            });

            var status = $("#status").select2({
                placeholder:'Status',
                width:'100%'
            })
        });
    </script>
@endsection