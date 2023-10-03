<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約一覧</title>
</head>
<body>
<h1>予約一覧</h1>

    @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif

<table border = "1"> 
    <tr>
        <th>作品</th>
        <th>座席</th>
        <th>予約者氏名</th>
        <th>メールアドレス</th>
        <th>日付</th>
    </tr>

    @foreach ($reservers as $reservation)
        <tr>
            <td>{{ $reservation->schedules->movie->title }}</td>
            <td>{{ $reservation->sheet->row . $reservation->sheet->column }}</td>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->email}}</td>
            <td>{{ $reservation->schedules->start_time->format('m/d H:i') }}</td>

        </tr>
    @endforeach
 </table>
 <a href="{{ route('movies') }}">映画一覧へ</a>
</body>