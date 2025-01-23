<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <style type="text/css">
        .page-break{
            page-break-after: always;
        }
    </style>    
    <body>
        @include('admin.processing_submissions.reports.partials._evaluation')
        <div class="page-break"></div>
        @include('admin.processing_submissions.reports.partials._extraction',['pageNum'=>false])
    </body>
</html>