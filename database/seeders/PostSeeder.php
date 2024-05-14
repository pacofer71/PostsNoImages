<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts=Post::factory(100)->create();
        foreach($posts as $post){
            $post->tags()->attach(self::getRandomTagsIdArray());
        }

    }
    private static function getRandomTagsIdArray(): array{
        $tagsId=Tag::pluck('id')->toArray();
        shuffle($tagsId);
        return array_slice($tagsId, 0, random_int(1, count($tagsId)));

    }
}
