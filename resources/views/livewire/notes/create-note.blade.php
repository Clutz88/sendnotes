<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        auth()->user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => false,
        ]);

        return to_route('notes.index');
    }
}; ?>

<div>
    <form wire:submit="submit" class="space-y-4">
        <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a great day"/>
        <x-textarea wire:model="noteBody" label="Your note" placeholder="Share all your thoughts with your friend"/>
        <x-input icon="user" wire:model="noteRecipient" label="Recipient" placeholder="yourfriend@email.com" type="email"/>
        <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send date" />
        <div class="pt-4">
            <x-errors />
            <x-button type="submit" primary right-icon="calendar" spinner class="mt-4">Schedule note</x-button>
        </div>
    </form>
</div>
