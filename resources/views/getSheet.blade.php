<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席一覧</title>
</head>
<body>

@php
    $counter = 0;
@endphp

<table border = "1">
    <tr>
        <th>ID</th>
        <th>座席</th>
    </tr>

@foreach($Sheets as $sheet)
    <tr>
        <td>{{ $sheet->id }}</td>
        <td>{{ $sheet->row .'-'. $sheet->column }}</td>
    </tr>
@endforeach
</table>

</body>
</head>