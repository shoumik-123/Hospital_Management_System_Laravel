
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Appointment Admin</title>

    @include('admin.css')
    <style>
        .table td {
            word-wrap: break-word;
        }
    </style>


</head>
<body>
<div class="container-scroller">

    @include('admin.sidebar')
    @include('admin.navbar')

    <div class="container-fluid page-body-wrapper">

        <div class="container-fluid p-28" >
            <table class="table text-light">
                <tr>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach($data as $appoint)
                    <tr>
                        <td>{{ $appoint->name }}</td>
                        <td>{{ $appoint->email }}</td>
                        <td>{{ $appoint->phone }}</td>
                        <td>{{ $appoint->doctor }}</td>
                        <td>{{ $appoint->date }}</td>
                        <td data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="{{ $appoint->message }}">
                            {{ Str::limit($appoint->message, 40) }} <!-- Display a truncated message -->
                        </td>

                        <td>
                            @if($appoint->status == "Approved")
                                <span class="badge badge-success">{{ $appoint->status }}</span>

                            @elseif($appoint->status == "Canceled")
                                <span class="badge badge-danger">{{ $appoint->status }}</span>
                            @else
                                <span class="badge badge-primary">{{ $appoint->status }}</span>

                            @endif
                        </td>
{{--                        <td>{{ $appoint->status }}</td>--}}
                        <td>
                            @if($appoint->status == "Approved")
                                <a class="btn btn-outline-danger" href="{{ route('cancelAppointments', $appoint->id) }}">Cancel</a>

                            @elseif($appoint->status == "Canceled")
                                <a class="btn btn-outline-success" href="{{ route('approveAppointments', $appoint->id) }}">Approve</a>
                            @else
                                <a class="btn btn-outline-success" href="{{ route('approveAppointments', $appoint->id) }}">Approve</a>
                                <a class="btn btn-outline-danger" href="{{ route('cancelAppointments', $appoint->id) }}">Cancel</a>
                            @endif


                        </td>

                    </tr>
                @endforeach


            </table>
        </div>

    </div>
</div>

@include('admin.script')
<!-- admin.script partial -->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>
