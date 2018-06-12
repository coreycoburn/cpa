<div class="hidden sm:flex bg-grey-light pt-6 pb-3 shadow sticky pin-t z-20">
    <nav class="container mx-auto">
        <ul class="flex list-reset justify-between text-sm md:text-lg xl:text-xl lg:mx-32">
            <li>
                <a
                    href="{{ route('welcome') }}"
                    class="{{ Request::is('/') ? 'active ' : '' }}no-underline text-grey-darkest font-bold uppercase hover:text-brand-dark"
                >
                    Home
                </a>
            </li>
            <li>
                <a
                    href="{{ route('about') }}"
                    class="{{ Request::is('about') ? 'active ' : '' }}no-underline text-grey-darkest font-bold uppercase hover:text-brand-dark"
                >
                    About
                </a>
            </li>
            <li>
                <a
                    href="{{ route('services') }}"
                    class="{{ Request::is('services') ? 'active ' : '' }}no-underline text-grey-darkest font-bold uppercase hover:text-brand-dark"
                >
                    Services
                </a>
            </li>
            <li>
                <a
                    href="{{ route('accolades') }}"
                    class="{{ Request::is('accolades') ? 'active ' : '' }}no-underline text-grey-darkest font-bold uppercase hover:text-brand-dark"
                >
                    Accolades
                </a>
            </li>
            <li>
                <a
                    href="{{ route('employment') }}"
                    class="{{ Request::is('employment') ? 'active ' : '' }}no-underline text-grey-darkest font-bold uppercase hover:text-brand-dark"
                >
                    Employment
                </a>
            </li>
            <li>
                <a
                    href="{{ route('quote') }}"
                    class="{{ Request::is('quote') ? 'active ' : '' }}no-underline text-grey-darkest font-bold uppercase hover:text-brand-dark"
                >
                    Free Quote!
                </a>
            </li>
        </ul>
    </nav>
</div>
