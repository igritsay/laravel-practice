@props([
    'test' => '123123'
])

<div class="alert alert-danger">
    {{ $test }}
    <h1>{{ $slot }}</h1>
</div>

