<div>
    Hello, {{ $contact->name  }}: {{ now() }}
    <button wire:click="$refresh">Refresh {{ $contact->id  }}</button>
    <button wire:click="$emit('refreshParent')">Refresh parentAlso {{ $contact->id  }}</button>
    <button wire:click="refreshParent">Refresh Me with parentAlso {{ $contact->id  }}</button>
</div>
