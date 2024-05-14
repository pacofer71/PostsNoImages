<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags=[
            'programacion'=>"#ef9a9a",
            'php'=>'#ce93d8',
            'c++'=>'#b39ddb',
            'java'=>'#9fa8da',
            'anime'=>'#90caf9'
        ];
        foreach($tags as $nombre=>$color){
            Tag::create(compact('nombre', 'color'));
        }
    }
}
