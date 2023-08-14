<div>
    Hello, {{ $contact->name  }}: {{ now() }}
    <button wire:click="$refresh">Refresh {{ $contact->id  }}</button>
</div>
