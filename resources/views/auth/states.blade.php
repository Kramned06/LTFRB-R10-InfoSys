@if (count($states)>0)
    {{-- <option value="">Choose state</option> --}}
    @foreach ($states as $state)
        <option value="{{ $state->id }}">{{ $state->name }}</option>
    @endforeach

@endif