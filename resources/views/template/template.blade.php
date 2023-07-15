<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Blank Page &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="/assets/modules/select2/dist/css/select2.min.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            
            {{-- BAGIAN NAVBAR --}}
            @include('template.navbar')
            {{-- / BAGIAN NAVBAR --}}
            
            {{-- BAGIAN SIDEBAR  --}}
            @include('template.sidebar')
            {{-- / BAGIAN SIDEBAR  --}}

            <!-- MAIN CONTENT -->
            @yield('content')
            <!-- /MAIN CONTENT -->

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2023 <div class="bullet"></div> Create by <a href="https://www.instagram.com/ranubim_/">RANUBIM</a>
                </div>
                {{-- <div class="footer-right">
                </div> --}}
            </footer>
            {{-- <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer> --}}
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/assets/modules/jquery.min.js"></script>
    <script src="/assets/modules/popper.js"></script>
    <script src="/assets/modules/tooltip.js"></script>
    <script src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/modules/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>
    <script src="/assets/modules/select2/dist/js/select2.full.min.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script src="/assets/js/page/forms-advanced-forms.js"></script>

    <!-- Template JS File -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script>
        $("document").ready(function()
        {
            setTimeout(function()
            {
                $("notip").remove();
            }, 3000);
        });
    </script>
</body>

</html>
