<div>
    <div>
        <input wire:model.live.debounce.1000="search">
        <button type="button"
            wire:click="clear"
        >Clear</button>
    </div>
    <div>
        <select wire:model.live="videoFormats" multiple>
            @foreach($allVideoFormats as $videoFormat)
                <option value="{{ $videoFormat->id }}">{{ $videoFormat->name }}</option>
            @endforeach
        </select>
    </div>

    @foreach ($dealsList as $deal)
        <h2 wire:click="delete({{ $deal->id }})" wire:key="{{ $deal->id }}">{{ $deal->name }} </h2>
    @endforeach
</div>
