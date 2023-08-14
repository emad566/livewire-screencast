<div>
    @foreach($contacts as $contact)
        @livewire('say-hi', ['contact'=>$contact], key($contact->name))
        <button wire:click="removeContact('{{ $contact->id }}')">Delete</button>
    @endforeach

    <hr>
        <button wire:click="$refresh">Refresh</button>

        Hello-world: {{ now() }}

</div>
