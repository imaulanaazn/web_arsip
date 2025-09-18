<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .header {
        text-align: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
        position: relative;
        }
        .logo {
        position: absolute;
        left: 20px;
        top: 10px;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }
        table, td {
        border: 1px solid black;
        }
        td {
        padding: 8px;
        vertical-align: top;
        }
        .footer {
        margin-top: 50px;
        text-align: right;
        }

        #filter-section {
            margin: 30px 0;
            text-align: start;
        }
    </style>
</head>
<body onload="window.print()" id="print_page">
    {!! $letterHead->content !!}

    <h2>{{ $title }}</h2>

    @if($since && $until && $filter)
    <div id="filter-section">
        periode: {{ "$since - $until" }}
        <br>
        Total: {{ count($data) }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>{{ __('model.letter.agenda_number') }}</th>
                <th>{{ __('model.letter.reference_number') }}</th>
                <th>{{ __('model.letter.to') }}</th>
                <th>{{ __('model.letter.letter_date') }}</th>
                <th>{{ __('model.letter.description') }}</th>
                <th>{{ __('model.letter.note') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $letter)
            <tr>
                <td>{{ $letter->agenda_number }}</td>
                <td>{{ $letter->reference_number }}</td>
                <td>{{ $letter->to }}</td>
                <td>{{ $letter->formatted_letter_date }}</td>
                <td>{{ $letter->description }}</td>
                <td>{{ $letter->note }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>