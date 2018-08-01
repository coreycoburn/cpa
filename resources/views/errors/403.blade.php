@extends('../layouts.app', ['title' => 'Quote Not Accessible'])

@section('body')
    <div
        class="container mx-auto max-w-md mt-8 mb-16 px-8 md:text-xl md:my-32 md:px-0 md:leading-loose"
    >
        {!! $exception->getMessage() !!}
    </div>
@endsection
