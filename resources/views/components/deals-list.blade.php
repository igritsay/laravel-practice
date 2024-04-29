<div {{ $attributes->merge(['class' => 'title']) }} xmlns:x-slot="http://www.w3.org/1999/xlink">
    <h1>{{ $title }}</h1>
    <x-subdirectory.alert>
        Alert Here
    </x-subdirectory.alert>
    @foreach($deals as $deal)
        <x-subdirectory.deal :$deal />
    @endforeach
</div>
