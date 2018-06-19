<label
    class="block text-grey-darker text-sm font-bold mb-2"
    for="{{ $id }}"
>
    {{ $slot }}
    @isset ($required)
        <span class="text-red">*</span>
    @endisset
</label>
<select
    id="{{ $id }}"
    name="{{ $id }}"
    class="appearance-none bg-white rounded w-full py-2 px-3 text-grey-darker leading-tight{{ $errors->has("$id") ? ' border border-red' : '' }}"
    @isset ($autofocus)
        autofocus
    @endisset
>
    <option value="" disabled selected></option>
    @foreach ($options as $key => $option)
        <option value="{{$key}}" {{ (old("$id") === $key ? "selected":"") }}>{{ $option }}</option>
    @endforeach
</select>

@if ($errors->has("$id"))
    <span class="text-sm text-red-dark mt-2 block" role="alert">
        {{ $errors->first("$id") }}
    </span>
@endif
