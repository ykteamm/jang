<!doctype html>
<html lang="en" class="h-100">


    @if (myHost() != 127)
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function(m, e, t, r, i, k, a) {
                m[i] = m[i] || function() {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                for (var j = 0; j < document.scripts.length; j++) {
                    if (document.scripts[j].src === r) {
                        return;
                    }
                }
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                    k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(92377487, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true,
                webvisor: true
            });
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/92377487" style="position:absolute; left:-9999px;" alt="" />
            </div>
        </noscript>
        <!-- /Yandex.Metrika counter -->
    @endif

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Jang Novatio</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('mobile/favv.jpg') }}">

        <!-- manifest meta -->
        <meta name="apple-mobile-web-app-capable" content="yes">


        @include('partials.css')
            <style>
                @media only screen and (max-width: 450px) {
                    body {
                        background-image: url('/promo/dist/img/promo/bg2.png');
                        background-repeat: no-repeat;
                    }
                }

                @media only screen and (min-width: 450px) {
                    body {
                        background: #bfe2ff;
                    }

                    .body-div {
                        width: 430px !important;
                        margin: 0 auto !important;
                        overflow: hidden;
                        background-image: url('/promo/dist/img/promo/bg2.png');
                        background-repeat: no-repeat;
                    }

                    .header {
                        padding: 10px 15px;
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 100%;
                        z-index: 99;
                        border-radius: 0;
                    }
                }
            </style>
        @livewireStyles
</head>

    <body data-page="landing">

        <div class="d-flex flex-column h-100 menu-overlay body-div" style="position: relative;">
            @include('components.loader')

            <div class="backdrop"></div>

            @include('components.header')

            <main class="flex-shrink-0 main has-footer">



                @yield('content')

            </main>
        </div>
        





        @include('partials.js')

        @yield('scripts')

        @livewireScripts


    </body>

</html>