<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public int $heartCount;

    public function mount(Note $note): void
    {
        $this->note = $note;
        $this->heartCount = $note->heart_count;
    }

    public function increaseHeartCount(): void
    {
        $this->note->update([
            'heart_count' => ++$this->heartCount,
        ]);
    }
}; ?>

<div>
    <x-button xs wire:click="increaseHeartCount" rose icon="heart" spinner>{{ $heartCount }}</x-button>
</div>
