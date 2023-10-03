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
    <tr width="200" height="100">
        <th >・</th>
        <th >・</th>
        <th >スクリーン</th>
        <th >・</th>
        <th >・</th>
    </tr>

       <tr>
        @foreach($Sheets as $sheet)

            @php
                $isReserved = in_array($sheet->id, $reserver);
            @endphp

            @if( $isReserved && $reservation )
                 <td align="center" bgcolor="#c0c0c0"  width="200" height="100">
                     {{ $sheet->row .'-'. $sheet->column }}
                </td>
            @else
                <td align="center"  width="200" height="100">
                    <a href="{{ route('create.reserve',['movie_id'=>$movie_id , 'schedule_id'=>$schedule_id  , 
                                                        'date'=>$date , 'sheetId'=>$sheet->id ]) }}">

                        {{ $sheet->row .'-'. $sheet->column }}
                    </a>
                </td>
            @endif                  

            @php
                $counter++;
                if ($counter % 5 == 0) {
                    echo '</tr><tr>';
                }
            @endphp
 
        @endforeach
        </tr>
</table>

</body>
</head>