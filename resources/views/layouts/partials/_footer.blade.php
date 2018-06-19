<div class="flex justify-end text-right mr-16 mb-4">
    <a
        href="#"
        v-scroll-to="'body'"
        class="fill-current text-white bg-brand-dark rounded-full w-16 h-16 text-center hover:bg-brand"
    >
        @svg('angle-up', 'h-16')
    </a>
</div>
<div class="bg-black py-16 text-grey-lightest carbonfiber">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <a
                href="{{ route('quote') }}"
                class="bg-brand-dark no-underline uppercase hover:bg-brand text-white text-2xl font-semibold hover:text-white py-4 px-8 border border-brand hover:border-transparent rounded"
            >
              Free Quote
            </a>
        </div>
        <ul class="flex list-reset justify-center mb-8 uppercase text-xl">
            <li class="mr-16">
                {{ config('company.phone.main') }}
            </li>
            <li class="mr-6">
                {{ config('company.phone.alt') }}
            </li>
        </ul>
        <div class="mb-16 text-center">
            <a
                href="{{ config('company.social.instagram') }}"
                target="_blank"
                class="mr-4 fill-current text-grey-lightest hover:text-blue-lighter"
            >
                @svg('instagram', 'h-12')
            </a>
            <a
                href="{{ config('company.social.facebook') }}"
                target="_blank"
                class="mr-4 fill-current text-grey-lightest hover:text-blue-lighter"
            >
                @svg('facebook-f', 'h-12')
            </a>
            <a
                href="{{ config('company.social.yelp') }}"
                target="_blank"
                class="fill-current text-grey-lightest hover:text-blue-lighter"
            >
                @svg('yelp', 'h-12')
            </a>
        </div>
        <div>
            <ul class="flex list-reset justify-center mb-8 uppercase">
                <li class="mr-6">
                    <a
                        href="https://members.cpavalet.com"
                        class="no-underline text-blue-light hover:text-blue"
                    >
                        Employee Login
                    </a>
                </li>
                <li>
                    <a
                        href="mailto:{{ config('company.email.main') }}"
                        class="no-underline text-blue-light hover:text-blue"
                    >
                        Contact
                    </a>
                </li>
            </ul>
        </div>
        <p class="text-center mb-3">
            {{ config('company.address.mailing.address') }}
            {{ config('company.address.mailing.city') }},
            {{ config('company.address.mailing.state') }}
            {{ config('company.address.mailing.zip') }}
        </p>
        <p class="text-center mb-3">
            Fax: {{ config('company.phone.fax') }}
        </p>
        <p class="text-center">
            &copy; {{ date('Y') }} {{ config('company.legal_name') }} All Rights Reserved.
        </p>
    </div>
</div>
