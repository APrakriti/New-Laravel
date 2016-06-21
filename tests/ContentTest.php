<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContentTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(App\User::class)->create();

        $this->assertTrue(true);

        $this->seeInDatabase('contents', ['slug' => 'nepal-rising']);

        $this->actingAs($user)
        	->visit('/admin/contents')
            ->see('Content Heading');

        $this->actingAs($user)
        	->click('Edit')
        	->see('Edit Content'); 
    }

    public function testContentEdit()
    {
    	$user = factory(App\User::class)->create();

    	$this->actingAs($user)
    		->visit('/admin/content/edit/1')
    		->see('Edit Content');

    	$this->actingAs($user)
    		->visit('/admin/content/add')
    		->see('Add Content');

    	$this->actingAs($user)
    		->visit('/admin/content/add')
    		->press('Submit')
    		->see('added successfully');
    }
}
