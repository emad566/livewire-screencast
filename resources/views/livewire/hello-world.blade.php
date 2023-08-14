<div>
    @foreach($contacts as $contact)
        @livewire('say-hi', ['contact'=>$contact], key($contact->name))
        <button wire:click="removeContact('{{ $contact->id }}')">Delete</button>
    @endforeach

    <hr>
        <button wire:click="refreshChildren">Refresh</button>
        <button wire:click="$emit('refreshChildren')">Refresh children only</button>

        Hello-world: {{ now() }}

</div>
