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
        <th>作品名</th>
        <th>座席</th>
        <th>スケジュールID</th>
        <th>シートID</th>
        <th>予約者氏名</th>
        <th>メールアドレス</th>
        <th>日付</th>
        <th>予約編集ボタン</th>
        <th>予約削除ボタン</th>
    </tr>

    @foreach ($reservers as $reservation)
        @if( $reservation->schedules->start_time > $now )
        <tr>   
            <td>{{ $reservation->schedules->movie->title }}</td>
            <td>{{ $reservation->sheet->row . $reservation->sheet->column }}</td>
            <td>{{ $reservation->schedule_id }}</td>
            <td>{{ $reservation->sheet_id }}</td>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->email }}</td>
            <td>{{ $reservation->date }}</td>

            <td><form action="{{ route('admin.edit.reservation', ['id'=>$reservation->id]) }}" method="GET">
            <button type="submit">編集画面へ</button>
            </form></td>

            <td><form action="{{ route('reserver.delete', ['id'=>$reservation->id]) }}" method="POST">
            @method('DELETE')
            @csrf
            <div align="center" >
            <button type="submit" align="center" onClick="return confirm('削除してよろしいですか？');">削除</button>
            </div>
            </form></td>
        </tr>
        @else

        @endif
    @endforeach
 </table>
</body>