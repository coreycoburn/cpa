<label
    class="block text-grey-darker text-sm font-bold mb-2"
    for="{{ $id }}"
>
    {{ $slot }}
    @isset ($required)
        <span class="text-red">*</span>
    @endisset
</label>

<input
    class="appearance-none rounded w-full py-2 px-3 text-grey-darker leading-tight{{ $errors->has("$id") ? ' border border-red' : '' }}"
    id="{{ $id }}"
    name="{{ $id }}"
    type="{{ (isset($type) && $type ? $type:"text") }}"
    value="{{ old("$id") }}"
    placeholder="{{ $slot }}"
    @isset ($autofocus)
        autofocus
    @endisset
>
@if ($errors->has("$id"))
    <span class="text-sm text-red-dark mt-2 block" role="alert">
        {{ $errors->first("$id") }}
    </span>
@endif
