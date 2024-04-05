<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{ $metaDescriptions->content ?? 'NAGOYAMESHIは名古屋のB級グルメに特化したレビューアプリです。' }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/4f4cd35b87.js" crossorigin="anonymous"></script>

        <link href="{{ asset('css/nagoyameshi.css') }}" rel="stylesheet">

        <!-- Laravel Cashier用のCSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            #card-element,#card-holder-name {
                border-radius: 4px 4px 0 0 ;
                padding: 12px;
                border: 1px solid rgba(50, 50, 93, 0.1);
                height: 44px;
                width: 100%;
                background: white;
            }
            button#card-button {
                background: #5469d4;
                color: #ffffff;
                font-family: Arial, sans-serif;
                border-radius: 0 0 4px 4px;
                border: 0;
                padding: 12px 16px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                display: block;
                box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
                width: 100%;
            }
        </style>  
    </head>

    <body>
         <div id="app">
             @component('components.header')
             @endcomponent

             <main class="py-4 mb-5">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
             </main>

             @component('components.footer')
             @endcomponent
         </div>
 
         <!-- Scripts -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
         @stack('scripts')
    </body>
</html>
