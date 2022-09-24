<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    div{
        text-align: center;
    }
    table, th, td {
        text-align: center;
        font-size: small;
        border: 1px solid rgb(180, 176, 176);
        border-collapse: collapse;
    }
    </style>
<body>
    
    <div>
        <h3>Monthly Punch Records</h3>
        {{-- <span><b>Name:</b> {{ $data_common->UserName }}</span><br>
        <span><b>Designation</b> {{ $data_common->designation }}</span><br>
        <span><b>Department:</b> {{ $data_common->department_name }}</span><br>
        <span><b>Branch:</b> {{ $data_common->branch_name }}</span><br>
        <span><b>Shift:</b> {{ $data_common->shift_name }}</span><br> --}}

        <div >
            <table id="info" style="width:50%; margin:auto">
                <tr class="info-tr">
                  <td class="info-td"><b>Employee Name</b></td>
                  <td class="info-td">{{ $data_common->UserName }}</td>
                </tr>
                <tr class="info-tr">
                  <td class="info-td"><b>Device User Id</b></td>
                  <td class="info-td">{{ $data_common->DevUserId }}</td>
                </tr>
                <tr class="info-tr">
                  <td class="info-td"><b>Designation</b></td>
                  <td class="info-td">{{ $data_common->designation }}</td>
                </tr>
                <tr class="info-tr">
                  <td class="info-td"><b>Department</b></td>
                  <td class="info-td">{{ $data_common->department_name }}</td>
                </tr>
                <tr class="info-tr">
                  <td class="info-td"><b>Branch</b></td>
                  <td class="info-td">{{ $data_common->branch_name }}</td>
                </tr>
                <tr class="info-tr">
                  <td class="info-td"><b>Shift</b></td>
                  <td class="info-td">{{ $data_common->shift_name }}</td>
                </tr>
                @foreach ($data as $key => $d)
                    @if ($key==1)
                    <tr class="info-tr">
                        <td class="info-td"><b>Office Start</b></td>
                        <td class="info-td">{{ \Carbon\Carbon::parse($d->AttendanceTime)->format('h:i a') }}</td>
                    </tr>
                    @endif
                    @if ($key==1)
                    <tr class="info-tr">
                        <td class="info-td"><b>Grace Time</b></td>
                        <td class="info-td">{{ \Carbon\Carbon::parse($d->GraceTime)->format('h:i a') }}</td>
                    </tr>
                    @endif
                    @if ($key==1)
                    <tr class="info-tr">
                        <td class="info-td"><b>Absent Time</b></td>
                        <td class="info-td">{{ \Carbon\Carbon::parse($d->AbsentTime)->format('h:i a') }}</td>
                    </tr>
                    @endif
                @endforeach

                
              </table>

        </div>
        <br>

        <table class="" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Punched Date</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Working Duration</th>
                    <th scope="col">Marking</th>
            </thead>
            <tbody>
                @foreach ($data as $key => $d)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->LoginDate)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->LoginTime)->format('h:i:s a') }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->LogoutTime)->format('h:i:s a') }}</td>
                    <td>
                        @if ($d->LoginTime==$d->LogoutTime)
                            {{ '00:00:00' }}
                        @else
                        {{ date('h:i:s', strtotime($d->LogoutTime)-(strtotime($d->LoginTime))) }}
                        @endif
                    </td>
                    <td>{{ $d->AttendanceStatus }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>