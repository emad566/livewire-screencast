<div>
    <input type="text" wire:model.debounce.1000ms="name">
    <label>
        loud
        <input type="checkbox" wire:model="loud">
    </label>

    <select wire:model="greating">
        <option>Hello</option>
        <option>Goodbye</option>
        <option>Adios</option>
    </select>

    <select wire:model="greatings" multiple="multiple">
        <option>Hello</option>
        <option>Goodbye</option>
        <option>Adios</option>
    </select>

    Live wire Hello: {{ $name }} @if($loud) yes! @endif
    <p>{{ $greating }}</p>
    <p>{{ implode(', ', $greatings) }}</p>
</div>
