<div class="bg-black text-white py-6 carbonfiber">
    @svg('menu', 'absolute sm:hidden h-6 pin-r mr-4 fill-current text-white')
    <div class="container mx-auto">
        <div class="flex justify-start sm:justify-between ml-32 sm:ml-0">
            <div class="flex flex-col sm:flex-row w-4/5 sm:w-2/5 xl:w-1/3 border-brand sm:border-t-2 sm:border-b-2 justify-center z-40">
                <div class="uppercase text-center text-3xl sm:text-4xl md:text-5xl xl:text-6xl mb-2">
                    {{ config('company.name') }}
                </div>
                <div class="sm:hidden text-center">
                    Premier Parking & Shuttle Service
                </div>
            </div>
            <div class="absolute sm:text-center pin-x pin-t ml-6 sm:ml-0 mt-2 z-30">
                @svg('logo', 'h-24 md:h-32 lg:h-40 xl:h-48')
            </div>
            <div class="hidden sm:flex w-2/5 xl:w-1/3 border-brand border-t-2 border-b-2 justify-center z-40">
                <div class="text-sm lg:text-xl xl:text-2xl">
                    <div class="mt-3 mb-3 text-center">
                        Premier Parking & Shuttle Service
                    </div>
                    <div>
                        <ul class="flex lg:justify-between flex-wrap justify-center list-reset text-xs xl:text-sm">
                            <li class="pr-2 lg:border-r border-grey-darker">San Francisco</li>
                            <li class="pr-2 lg:border-r border-grey-darker">Napa</li>
                            <li class="pr-2 lg:border-r border-grey-darker">Sonoma</li>
                            <li class="pr-2 lg:border-r border-grey-darker">Marin</li>
                            <li>East Bay</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex mt-8 pt-4 border-t border-brand mx-6 sm:border-none sm:mx-0 sm:pt-0 sm:mt-4 text-sm md:text-md xl:text-xl">
            <div class="flex flex-col md:flex-row w-2/5 xl:w-1/3 justify-between md:px-6 z-40">
                <div class="flex justify-center">
                    Marin / SF Bay Area
                </div>
                <div class="flex justify-center">
                    {{ config('company.phone.main') }}
                </div>
            </div>
            <div class="w-1/5 xl:w-1/3">

            </div>
            <div class="flex flex-col md:flex-row w-2/5 xl:w-1/3 justify-between md:px-8 z-40">
                <div class="flex justify-center">
                    Napa / Sonoma
                </div>
                <div class="flex justify-center">
                    {{ config('company.phone.alt') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials._nav')
