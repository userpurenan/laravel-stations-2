<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>上映一覧</title>
</head>
<body>
    <h1>現在上映中の映画</h1>

    <h2>現在時刻 {{ $now->format('H:i') }}</h2>
<table border = "1"> 
    <tr>
        <th>スクリーン</th>
        <th>上映中又はこれから上映の映画</th>
        <th>開始時刻</th>
        <th>終了時刻</th>
        <th>スケジュールID</th>
        <th>ムービーID</th>
    </tr>

    @foreach ($screens as $screen)
    <tr>
        <td>{{ $screen->name }}</td>
        <td>{{ $screen->movie->title }}</td>
        <td>{{ $screen->start_time}}</td>
        <td>{{ $screen->end_time }}</td>
        <td>{{ $screen->id }}</td>
        <td>{{ $screen->movie_id }}</td>
    </tr>
    @endforeach
 </table>
</body>