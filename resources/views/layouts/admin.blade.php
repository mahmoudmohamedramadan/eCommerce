<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title','Dashboard | eCommerce')</title>

    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/menu/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/custom-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/style-rtl.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

    </style>
</head>

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-col="2-columns">

    @include('admin.includes.header')
    @include('admin.includes.sidebar')
    @yield('content')
    @include('admin.includes.footer')

    <script src="{{ asset('assets/admin/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: `{{ route('pushNotifications') }}`,
                dataType: 'json',
                success: function(data) {
                    $('.scrollable-container').empty().html(data.notifications);
                    $('#notifications_count').empty().html(data.notifications_count);
                    $('#notifications_count_new').empty().html(`${data.notifications_count} New`);
                },
                error: function(data) {
                    console.log(data);
                }
            });

            $('#read-all-notifications').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: $(this).attr('href'),
                    dataType: 'json',
                    success: function(data) {
                        $('.scrollable-container').empty();
                        $('#notifications_count').empty().html(0);
                        $('#notifications_count_new').empty().html('0 New');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })
        });

    </script>
    @stack('script')
</body>

</html>
