<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>{{page_title}}</title>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>-->
          <script src="public/js/jquery.js"></script>
            <script type="text/javascript" src="public/js/bootstrap.js" ></script>
            <link rel="stylesheet"  href="public/css/bootstrap.css" rel="stylesheet" >
            <link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
            <link rel="stylesheet" href="public/css/datatable-bootstrap.min.css" type="text/css">
            <link rel="stylesheet" href="public/css/datatable.min.css" type="text/css">
            <link rel="stylesheet" href="public/css/bootstrap-notifications.css" type="text/css">
            <link rel="stylesheet" href="public/css/bootstrap-dropmenu.css" type="text/css">
            <script type="text/javascript" src="public/js/datatable.jquery.js"></script>
            <script type="text/javascript" src="public/js/datatable.js"></script>
            <script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
            {{foreach css_ref}}
                <link rel="stylesheet" href="{{uri}}" />
            {{endfor css_ref}}
        </head>
        <body>
          {{diaslayout}}
          {{page_header}}
            <div class="contenido">
                {{{page_content}}}
            </div>
            {{page_header2}}
        </body>
    </html>

