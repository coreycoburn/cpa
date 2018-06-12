<div class="w-full md:w-1/3 px-8">
    <div>
        <div class="flex items-center mb-3">
            <div class="mr-3">
                @svg('check-circle', 'h-8 fill-current text-green')
            </div>
            <h3 class="mb-2">
                {{ $title }}
            </h3>
        </div>
        <p class="mb-8">
            {{ $slot }}
        </p>
    </div>
</div>
