<?php


class ShowPostTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_see_a_post()
    {
        //Having
        $user = $this->defaultUser([ 
            'name' => 'Agustin'
        ]);
        
        $post = $this->createPost([
            'title' => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id
        ]);


        //When
        $this->visit($post->url)
             ->seeInElement('h1', $post->title)
             ->see($post->content)
             ->see('Agustin');
    }

    function test_old_url_redirect_to_new_url()
    {
        //Having

	     $post = $this->createPost([
            'title' => 'Old title'
        ]);
        
        
        $url = $post->url;
        
        $post->update([ 'title' => 'New title' ]);
        
        $this->visit($url)
	    	->seePageIs($post->url);
    }
}
