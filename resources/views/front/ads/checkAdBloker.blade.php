<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
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
                    alert('Please disable ad block')
                } else {
                    if (window.location.href.split('/')[4] == 'ad') {
                        window.location.href = window.location.href + '/visit-ad';
                    } else {
                        window.location.href = window.location.href + '/visit-library';
                    }
                }
            }
        }

        detectAdBlock()
    </script>
</head>
<body style='background-color:black'>


<!-- start scripts included -->
<!-- bootstrap included -->
<script src={{asset('js/bootstrap.bundle.js')}}></script>
<!-- jquery included -->
<script src="{{asset('js/jquery.js')}}"></script>
</body>
</html>





