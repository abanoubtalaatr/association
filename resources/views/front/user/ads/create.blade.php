@extends('layouts.user')
@section('content')
    @if(app()->getLocale()=='en')

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-YSYRG0BBDG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-YSYRG0BBDG');
        </script>


        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186147787-1"></script>
        <script>

            async function detectAdBlock() {
                let adBlockEnabled = false
                const googleAdUrl = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
                try {
                    await fetch(new Request(googleAdUrl)).catch(_ => adBlockEnabled = true)
                } catch (e) {
                    adBlockEnabled = true
                } finally {
                    if (adBlockEnabled == true) {
                        alert('Please deactivate your ad blocker to be able to create an ad, then refresh the page.');
                    }
                }
            }

            detectAdBlock()
        </script>
    @else

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-YSYRG0BBDG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-YSYRG0BBDG');
        </script>

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186147787-1"></script>
        <script>

            async function detectAdBlock() {
                let adBlockEnabled = false
                const googleAdUrl = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
                try {
                    await fetch(new Request(googleAdUrl)).catch(_ => adBlockEnabled = true)
                } catch (e) {
                    adBlockEnabled = true
                } finally {
                    if (adBlockEnabled == true) {
                        alert('برجاء الغاء تفعيل مانع الاعلانات وثم القيام بأعادة تحميل الصفحة من جديد لتتمكن من انشاء اعلان.');
                    }
                }
            }

            detectAdBlock()
        </script>
    @endif
    @livewire('user.ads.create-ad')
@endsection
