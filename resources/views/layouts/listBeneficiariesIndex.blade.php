@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Beneficiaries</a>
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
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Place of Study</th>
                        <th>Year of Study</th>
                        <th>Address</th>
                        <th>IDNP</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Register Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Place of Study</th>
                        <th>Year of Study</th>
                        <th>Address</th>
                        <th>IDNP</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Register Date</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($beneficiaries as $beneficiary)
                        <tr>
                            <td>{{$beneficiary->first_name}}</td>
                            <td>{{$beneficiary->last_name}}</td>
                            <td>{{\App\PlaceStudy::find($beneficiary->study_place_id)->name}}</td>
                            <td>{{$beneficiary->study_year}}</td>
                            <td>{{$beneficiary->address}}</td>
                            <td>{{$beneficiary->idnp}}</td>
                            <td>{{$beneficiary->tel_number}}</td>
                            <td>{{$beneficiary->email}}</td>
                            <td>{{$beneficiary->birthday}}</td>
                            <td>{{$beneficiary->created_at}}</td>
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