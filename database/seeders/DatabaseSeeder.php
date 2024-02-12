<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Deal;
use App\Models\User;
use App\Models\VideoFormat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(100)->create()->each(function(User $user) {
             $user->address()->save(Address::factory()->make());
         });

        $formats = new Collection();
        $formats[] = VideoFormat::factory()->create([
         'name' => 'Teaser',
        ]);
        $formats[] = VideoFormat::factory()->create([
            'name' => 'Highlight',
        ]);
        $formats[] = VideoFormat::factory()->create([
            'name' => 'Full Documentary',
        ]);
        $formats[] = VideoFormat::factory()->create([
            'name' => 'Ceremony',
        ]);
        $formats[] = VideoFormat::factory()->create([
            'name' => 'Speeches',
        ]);

        $deals = Deal::factory(100)->create();

        $deals->each(function (Deal $deal) use ($formats) {
            $deal->videoFormats()->attach([1]);
        });


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
