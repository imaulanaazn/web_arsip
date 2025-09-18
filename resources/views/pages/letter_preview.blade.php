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
<body onload="window.print()" id="body">
    {!! $letterHead->content !!}
    {!! $content !!}
</body>
</html>