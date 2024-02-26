<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Deal;
use App\Models\User;
use App\Models\VideoFormat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        $adminUser = User::factory()->create([
            'name'        => 'admin',
            'email'       => 'admin@example.com',
            'password'    => Hash::make('admin'),
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);

        User::factory(100)->create()->each(function(User $user) use ($formats) {
            $deals = Deal::factory(10)->create();
            $deals->each(function (Deal $deal) use ($formats) {
                $deal->videoFormats()->attach(
                    $formats
                        ->random(rand(1, 5))
                        ->pluck('id')
                        ->toArray()
                );
            });

            $user->address()->save(Address::factory()->make());
            $user->deals()->saveMany($deals);
        });
    }
}
