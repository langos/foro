<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends FeatureTestCase
{    
    
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_basic_example()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Agustin',
            'email' => 'sanchezfabrega@gmail.com'
        ]);

        $this->actingAs($user, 'api')
             ->visit('api/user')
             ->see('Agustin')
             ->see('sanchezfabrega@gmail.com');
    }
}