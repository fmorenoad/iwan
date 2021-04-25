<footer class="footer">
    <div class="container">
        <nav>
            <ul class="footer-menu">
                <li>
                    <a href="felipe.morenod@gmail.com" class="nav-link" target="_blank">{{ env('APP_DEVELOPER') }}</a>
                </li>
                <li>
                    <a href="https://www.iwan.cl" class="nav-link" target="_blank">{{ __('iWan Enterprise') }}</a>
                </li>
                <li>
                    <a href="https://www.iwan.cl/about" class="nav-link" target="_blank">{{ __('About Us') }}</a>
                </li>
                <li>
                    <a href="https://www.iwan.cl/contact" class="nav-link" target="_blank">{{ __('Contact') }}</a>
                </li>
            </ul>
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="http://www.iwan.cl">{{ __('iWan Enterprise') }}</a> {{ __(', made with love for a better web') }}
            </p>
        </nav>
    </div>
</footer>
