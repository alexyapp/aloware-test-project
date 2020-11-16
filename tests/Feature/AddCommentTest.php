<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddCommentTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    public function __construct()
    {
        $this->post = Post::create();
    }

    /**
     * @test
     */
    public function can_add_a_comment()
    {
        $this->post("/api/Post/{$this->post->id}/comments", [
            'name' => 'test',
            'body' => 'test',
        ])
            ->assertStatus(201);
    }

    /**
     * @test
     */
    public function can_not_add_a_comment_if_name_is_missing()
    {
        $this->post("/api/Post/{$this->post->id}/comments", [
            'body' => 'test',
        ])
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function can_not_add_a_comment_if_body_is_missing()
    {
        $this->post("/api/Post/{$this->post->id}/comments", [
            'name' => 'test',
        ])
            ->assertStatus(422);
    }
}
