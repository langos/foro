<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Comment;

class MarkCommentAsAnswerTest extends TestCase
{
    
    use DatabaseTransactions;

    function test_a_post_can_be_answered()
    {
        $post = $this->createPost();
        $comment = factory(Comment::class)->create([
        		'post_id' => $post->id
        	]);
        $comment->markAsAnswer();
        $this->assertTrue($comment->fresh()->answer);
        $this->assertFalse($post->fresh()->pending);
    }
    function test_a_post_only_can_have_one_answer()
    {
        $post = $this->createPost();
        $comments = factory(Comment::class)->times(2)->create([
        		'post_id' => $post->id
        	]);
        $comments->first()->markAsAnswer();
        $comments->last()->markAsAnswer();
        $this->assertFalse($comments->first()->fresh()->answer);
        $this->assertTrue($comments->last()->fresh()->answer);
    }
}
