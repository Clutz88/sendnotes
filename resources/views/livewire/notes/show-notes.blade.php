<?php

use Livewire\Volt\Component;

new class extends Component {
    public function delete($note_id)
    {
        $note = \App\Models\Note::where('id', $note_id)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }
    public function with(): array
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->latest('send_date')
                ->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Let's create your first note to send.</p>
                <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create note</x-button>
            </div>
        @else
            <x-button primary icon-right="plus" class="mb-12" href="{{ route('notes.create') }}" wire:navigate>Create note</x-button>
            <div class="grid grid-cols-3 gap-4">
            @foreach($notes as $note)
                <x-card wire:key="{{ $note->id }}">
                    <div class="flex justify-between">
                        <div>
                            <a href="{{route('notes.edit', $note)}}" wire:navigate class="text-xl font-bold hover:underline hover:text-blue-500">
                                {{ $note->title }}
                            </a>
                            <p class="text-xs mt-2">{{Str::limit($note->body, 50)}}</p>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('jS M Y') }}
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                        <div>
                            <x-button.circle icon="eye" />
                            <x-button.circle icon="trash" wire:click="delete('{{ $note->id }}')" />
                        </div>
                    </div>
                </x-card>
            @endforeach
            </div>
        @endif
    </div>
</div>
