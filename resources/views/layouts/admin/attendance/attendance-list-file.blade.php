<!DOCTYPE html>
<html>

<head>
    <title>Attendance List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <style>
        table {
            width: 100%;
            margin-right: 20px;
        }

        table,
        th,
        td {
            font-size: x-small;
            border: 1px solid rgb(180, 176, 176);
            border-collapse: collapse;
        }

    </style>

    <h4 class="text-center">Master Fishing</h4>
    <h6 class="text-center">Attendance
        @isset($branchInfo)
            - {{ $branchInfo->branch_name }}
        @endisset
        @isset($shiftData)-{{ $shiftData->shift_name }}-@if ($shiftData->type == 1)
            {{ 'Day Shift' }} {{ '(' }}{{ $today }}{{ ')' }}
        @elseif($shiftData->type == 2)
            {{ 'Night Shift' }} {{ '(' }}{{ $yesterday }}-{{ $today }}{{ ')' }}
        @endif
    @endisset
</h6>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">S/N</th>
            <th scope="col">Name</th>
            <th scope="col">Designation</th>
            <th scope="col">Device User ID</th>
            {{-- <th scope="col">Device</th> --}}
            <th scope="col">In Time</th>
            <th scope="col">Out Time</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>


        @isset($data)
            @if ($data == 'holiday')
                <tr class="text-center">
                    <td colspan="9">
                        <h4>{{ 'Today is a holiday !' }}</h4>
                    </td>
                </tr>
            @else
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $item[0]['username'] }}</td>
                        <td>{{ $item[0]['designation'] }}</td>
                        <td>{{ $item[0]['user_id'] }}</td>
                        {{-- <td>{{ $item[0]['device_name'] }}</td> --}}
                        <td>
                            @if ($item[0]['in_time'])
                                {{ \Carbon\Carbon::parse($item[0]['in_time'])->format('d-m-y h:i:s a') }}
                            @endif

                        </td>
                        <td>
                            @if ($item[0]['in_time'])
                                {{ \Carbon\Carbon::parse($item[0]['out_time'])->format('d-m-y h:i:s a') }}
                            @endif

                        </td>
                        <td>
                            @if ($item[0]['status'] == 'present')
                                @if ($shiftData->type == 1)
                                    @if (isset($item[0]['in_time']))
                                        @if (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') < $shiftData->grace_time)
                                            <span class="alert-success px-2 rounded">P</span>
                                        @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') <= $shiftData->absent_time)
                                            <span class="px-2 rounded alert-warning">L</span>
                                        @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->absent_time)
                                            <span class="px-2 rounded alert-danger">A</span>
                                        @endif
                                    @else
                                        <span class="px-2 rounded alert-danger">A</span>
                                    @endif
                                @endif


                                @if ($shiftData->type == 2)
                                    @if (isset($item[0]['in_time']))
                                        @if (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') < $shiftData->grace_time)
                                            <span class="px-2 rounded alert-success">P</span>
                                        @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') <= $shiftData->absent_time)
                                            <span class="px-2 rounded alert-warning">L</span>
                                        @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->absent_time)
                                            <span class="px-2 rounded alert-danger">A</span>
                                        @endif
                                    @else
                                        <span class="px-2 rounded alert-danger">A</span>
                                    @endif
                                @endif
                            @elseif ($item[0]['status'] == 'absent')
                                <span class="px-2 rounded text-danger">Absent</span>
                            @elseif ($item[0]['status'] == 'On Leave')
                                <span class="px-2 rounded text-info">Leave</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            @endif
        @endisset

    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>
