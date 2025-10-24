<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        // Pievienot komentārus pirmam postam no John
        $user1 = User::where('email', 'john@example.com')->first();
        $post1 = $user1->posts()->first();

        $post1->comments()->create([
            'comment' => 'Great post, John!',
            'user_id' => $user1->id
        ]);

        // Pievienot komentārus otrajam postam no Jane
        $post2 = $user1->posts()->skip(1)->first();

        $post2->comments()->create([
            'comment' => 'Interesting second post, John!',
            'user_id' => $user2->id
        ]);

        // Pievienot komentārus trešajam postam no Jane
        $post3 = $user2->posts()->first();

        $post3->comments()->create([
            'comment' => 'Nice first post, Jane!',
            'user_id' => $user1->id
        ]);
    }
}
