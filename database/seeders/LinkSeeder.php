<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Link;
use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link as InlineLink;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 50; $i++) {
            Link::create([
                'code' => self::uniqueCode(),
                'long_url' => fake()->url(),
                'clicks' => fake()->numberBetween(0, 500),
            ]);
        }
    }
    public static function uniqueCode($len = 6): string{
        do{
            $code = Str::lower(Str::random($len));
        }while(Link::where('code',$code)->exists());
        return $code;
      
    }
}
