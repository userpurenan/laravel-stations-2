<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール一覧</title>
</head>
<body>
<table border = "1"> 
    <tr>
        <th>スケジュールID</th>
        <th>movie_id</th>
        <th>上映開始時間</th>   
        <th>上映終了時間</th>
    </tr>

    @foreach ($schedules as $schedule)
    <tr>
        <td>{{ $schedule->id }}</td>
        <td>{{ $schedule->movie_id }}</td>
        <td>{{ $schedule->start_time }}</td>
        <td>{{ $schedule->end_time }}</td>
    </tr>
    @endforeach
 </table>
</body>