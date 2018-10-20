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
            <form action="{{route('beneficiaries.edit.save')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$beneficiary->id}}">
                <div class="form-group">
                    <input type="text" class="form-control" required name="first_name" value="{{$beneficiary->first_name}}" placeholder="First Name" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" required name="last_name" value="{{$beneficiary->last_name}}" placeholder="Last Name" />
                </div>
                <div class="form-group">
                    <input type="number" min="1" max="4" step="1" class="form-control" value="{{$beneficiary->study_year}}" required name="study_year" placeholder="Study Year" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" required name="address" placeholder="Address" value="{{$beneficiary->address}}" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" required name="idnp" value="{{$beneficiary->idnp}}" placeholder="IDNP" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" required name="phone" placeholder="Phone Number" value="{{$beneficiary->tel_number}}" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" required name="email" placeholder="Email" value="{{$beneficiary->email}}" />
                </div>
                <div class="form-group">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" name="birthday" value="{{$beneficiary->birthday}}" placeholder="Birthday" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <select id="study_place" class="form-control" required title="Study Place" name="study_place">
                        <option></option>
                        @foreach(\App\PlaceStudy::all() as $item)
                            <option {{$beneficiary->study_place_id==$item->id ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                    <a href="{{route('beneficiary.delete.page',$beneficiary->id)}}" class="btn btn-danger">Delete record</a>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
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

            var study_place = $("#study_place").select2({
                placeholder:'Place of Study',
                width:'100%'
            });
        });
    </script>
@endsection