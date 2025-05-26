<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Permintaan ATK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            font-size: 12px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 5px 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        ul {
            margin: 0;
            padding-left: 15px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .col-6 {
            width: 50%;
        }

        .col-12 {
            width: 100%;
        }

        .mb-4 {
            margin-bottom: 30px;
        }

        .mt-5 {
            margin-top: 50px;
        }

        @page {
            margin: 1cm;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>