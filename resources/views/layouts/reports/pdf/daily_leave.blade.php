<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Leave Report</title>
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
        <h3>Daily Leave Report</h3>
        <h4>{{ \Carbon\Carbon::parse($fullDate)->format('d F, Y') }}</h4>
        <table style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Leave Duration</th>
                    <th scope="col">Type</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Approved By</th>
            </thead>
            <tbody>
                @foreach ($results as $key => $data)
                    
                <tr>
                    <td>{{Carbon\Carbon::parse($fullDate)->format('d/m/Y') }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ Carbon\Carbon::parse($data->leave_start_date)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($data->leave_end_date)->format('d/m/Y') }}</td>
                    <td>{{ $data->type }}</td>
                    <td>{{ $data->leave_cause }}</td>
                    <td>{{ $data->appr_name }}</td>
                </tr>
            
                   
                @endforeach


            </tbody>
        </table>
    </div>
</body>
</html>