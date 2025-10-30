<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\IdeaStatus;
use App\Models\Idea;
use App\Models\User;



class IdeaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create(['email' => 'demo@example.com']);
        Organizer::factory()->count(12)->create([
            'user_id' => $user->id,
        ]);
    }
}