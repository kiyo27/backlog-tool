<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Laravel</title>
      
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      
   </head>
   <body>
      <div id="app">
         <dashboard-component></dashboard-component>
      </div>

      <script src="./js/app.js"></script>
   </body>
</html>
