<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function(User $user) {
            Note::factory()
                ->count(5)
                ->recycle($user)
                ->create();
        });
    }
}
