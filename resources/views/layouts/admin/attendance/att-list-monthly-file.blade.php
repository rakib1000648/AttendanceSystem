<!DOCTYPE html>
<html>

<head>
    <title>Attendance List Monthly</title>
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
    <h5 class="text-center">Attendance list monthly
        @isset($shiftData)-{{ $shiftData->shift_name }}-@if ($shiftData->type == 1)
            {{ 'Day Shift' }}
        @elseif($shiftData->type == 2)
            {{ 'Night Shift' }}
        @endif
    @endisset
</h5>

<table class="text-center">

    <thead>
        @isset($data)
            <tr>
                <th scope="col">S/N</th>
                <th scope="col">Employee</th>

                @foreach ($dates as $date)
                    <th scope="col">{{ $date }}</th>
                @endforeach

            </tr>
        @endisset



    </thead>
    <tbody>

        @isset($data)
            @foreach ($data as $key => $item)
                <tr class="data_tr">

                    <td>{{ $sl++ }}</td>
                    <td>{{ $item[0]['username'] }}</td>

                    @if (isset($item[0]['in_time']))
                        @foreach ($item[0]['in_time'] as $in_data)
                            @if ($in_data)
                                @if ($in_data == 'H')
                                    <td><span class="px-2 rounded alert-dark">H</span></td>
                                @elseif ($in_data == 'LV')
                                    <td><span class="px-2 rounded alert-info">LV</span></td>
                                @else
                                    @if (isset($shiftData->type) && $shiftData->type == 1)
                                        @if (\Carbon\Carbon::parse($in_data)->format('H:i:s') < $shiftData->grace_time)
                                            <td> <span class="alert-success px-2 rounded">P</span></td>
                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($in_data)->format('H:i:s') <= $shiftData->absent_time)
                                            <td> <span class="px-2 rounded alert-warning">L</span></td>
                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->absent_time)
                                            <td><span class="px-2 rounded alert-danger">A</span></td>
                                        @endif
                                    @endif

                                    @if (isset($shiftData->type) && $shiftData->type == 2)
                                        @if (\Carbon\Carbon::parse($in_data)->format('H:i:s') < $shiftData->grace_time)
                                            <td> <span class="alert-success px-2 rounded">P</span></td>
                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($in_data)->format('H:i:s') <= $shiftData->absent_time)
                                            <td> <span class="px-2 rounded alert-warning">L</span></td>
                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->absent_time)
                                            <td><span class="px-2 rounded alert-danger">A</span></td>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <td><span class="px-2 rounded alert-danger">A</span></td>
                            @endif
                        @endforeach
                    @else
                        <td colspan="{{ $item[0]['last_day'] }}"><strong>Didn't punched this month
                                !</strong>
                        </td>
                    @endif

                </tr>
            @endforeach
        @endisset

    </tbody>

</table>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>
