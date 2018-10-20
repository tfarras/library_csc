@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Books</a>
        </li>
        <li class="breadcrumb-item active">List View</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            List of Books
        </div>
        <div class="card-body" >
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="max-height: 76vh" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>UID</th>
                        <th style="width: 20%">Book Name</th>
                        <th style="width: 15%">Author</th>
                        <th style="width: 10%">Edition</th>
                        <th>Year of Publication</th>
                        <th>Category</th>
                        <th>Language</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Added at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>UID</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Edition</th>
                        <th>Year of Publication</th>
                        <th>Category</th>
                        <th>Language</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Added at</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->name}}</td>
                            <td>{{\App\Author::find($book->author_id)->name}}</td>
                            <td>{{\App\Edition::find($book->edition_id)->name}}</td>
                            <td>{{$book->publication_year}}</td>
                            <td>{{\App\Category::find($book->category_id)->name}}</td>
                            <td>
                                {{($book->code)==1 ? 'Romanian' : ''}}
                                {{($book->code)==2 ? 'Russian' : ''}}
                                {{($book->code)==3 ? 'English' : ''}}
                            </td>
                            <td>{{\App\Category::find($book->category_id)->code.'.'.$book->code}}</td>
                            <td>{{\App\BookStatus::find($book->status_id)->name}}</td>
                            <td>{{$book->created_at}}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{route('books.edit.page',$book->id)}}"><i class="fa fa-list fa-2x" style="color:black"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
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
        });
    </script>
@endsection