<!DOCTYPE html>
<html>
<head>
    <title>Leaves Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>

    <h4 class="text-center">Master Fishing</h4>
    <h5 class="text-center">Leaves Report - branch : @if ($branch == 'All')
        {{ 'All' }}
    @else
    {{ $branch->branch_name }}
    @endif- {{ $year }}</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">S/N</th>
                <th scope="col">Employee</th>
                <th scope="col">Designation</th>
                <th scope="col">Total</th>
                <th scope="col">Annual</th>
                <th scope="col">Sick</th>
                <th scope="col">Casual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['designation'] }}</td>
                <td class="text-warning"><strong>{{ $item['leave_total'] }} {{ 'days' }}</strong></td>
                <td>{{ $item['annual_total'] }} {{ 'days' }}</td>
                <td>{{ $item['casual_total'] }} {{ 'days' }}</td>
                <td>{{ $item['sick_total'] }} {{ 'days' }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
