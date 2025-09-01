<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aplikasi {{ $title ?? config('app.name') }}</title>
    @include('components.layouts.style')


</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
    <x-layouts.front-end.nav-bar />
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content pt-3">
                <div class="container">
                    {{ $slot }}
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <x-layouts.footer />
    </div>
    @include('components.layouts.script')
</body>

</html>
