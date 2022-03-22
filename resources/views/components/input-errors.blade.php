@props([
    'messages' => []
])

@foreach ($messages as $message)
<span id="basic-default-name-error" class="error">{{ $message }}</span>
@endforeach
