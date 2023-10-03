<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者映画予約</title>
</head>
<body>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
@endif

@if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif

    <h1>管理者映画予約画面</h1>

    <form action="{{ route('admin.reserve.store') }}" method="POST">
        @csrf

        <div>
            <label for="movie_id">映画ID</label>
            <input type="text" name="movie_id" id="movie_id">
        </div>


        <div>
            <label for="schedule_id">スケジュールID</label>
            <input type="text" name="schedule_id" id="schedule_id">
        </div>


        <div>
            <label for="sheet_id">シートID</label>
            <input type="text" name="sheet_id" id="sheet_id"  >
        </div>
        

        <div>
            <label for="date">日付</label>
            <input type="date" name="date" id="date">
        </div>


        <div>
            <label for="description">予約者氏名</label>
            <input tupe="text" name="name" id="name" >
        </div>
       

        <div>
          <label for="genre">予約者メールアドレス:</label>
          <input type="email" name="email" id="email" >
        </div>


        <div>
            <button type="submit">登録</button>
        </div>
    </form>
</body>
</html>