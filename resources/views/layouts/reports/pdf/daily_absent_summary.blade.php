<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Absent Summary</title>
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
        <h3>Daily Absent Summary</h3>
        <h4>{{ \Carbon\Carbon::parse($fullDate)->format('d F, Y') }}</h4>
        <table style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Department</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Shift</th>
                    <th scope="col">Office Start</th>
                    <th scope="col">Grace</th>
                    <th scope="col">Punched At</th>
                    <th scope="col">Marking</th>
            </thead>
            <tbody>
                @foreach ($results as $key => $data)
                    
                @if ($data['marking']=='Absent')
                <tr>
                    <td>{{ $data['dev_emp_id'] }}</td>
                    <td>{{ $data['username'] }}</td>
                    <td>{{ $data['department_name'] }}</td>
                    <td>{{ $data['designation'] }}</td>
                    <td>{{ $data['shift_name'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($data['office_start'])->format('h:i a') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data['grace_time'])->format('h:i a') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data['first_punch'])->format('h:i:s a') }}</td>
                    <td><span class="status_btn bg-danger">{{ $data['marking'] }}</span></td>
                </tr>
                @endif
                   
                @endforeach


            </tbody>
        </table>
    </div>
</body>
</html>