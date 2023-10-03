<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ジャンル一覧</title>
</head>
<body>
<table border = "1"> 
    <tr>
        <th>ID</th>
        <th>ジャンル</th>   
    </tr>

    @foreach ($Genres as $Genre)
    <tr>
        <td>{{ $Genre->id }}</td>
        <td>{{ $Genre->name }}</td>
    </tr>
    @endforeach
 </table>
</body>