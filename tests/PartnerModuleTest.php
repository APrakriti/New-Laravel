<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartnerModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
    * Check partners url exists 
    *
    * @return void
    */
    public function testUrl()
    {
    	$user = factory(App\User::class)->create();
    	$response = $this->actingAs($user)->call('GET', '/admin/partners');

    	$this->assertEquals(200, $response->status());
	}

    /**
    * Check partners add new link working
    *
    * @return void
    */
    public function testAddLink()
    {
    	$user = factory(App\User::class)->create();
    	
    	$this->actingAs($user)
    		->visit('/admin/partners')
    		->click('Add New')
    		->seePageIs('/admin/partner/add');
    }

    /**
    * Check partner add url exists 
    *
    * @return void
    */
    public function testAddUrl()
    {
    	$user = factory(App\User::class)->create();
    	$response = $this->actingAs($user)->call('GET', '/admin/partner/add');

    	$this->assertEquals(200, $response->status());
    }

    /**
    * Check with empty form fields
    *
    * @return void
    */
    public function testBlankFields()
    {
    	$user = factory(App\User::class)->create();

    	$this->actingAs($user)
    			->visit('/admin/partner/add')
    			->press('add')
    			->seePageIs('/admin/partner/add');
    }

    /**
    * Check with wrong values
    *
    * @return void
    */
    public function testWrongData()
    {
    	$user = factory(App\User::class)->create();
		$this->actingAs($user)
    			->visit('/admin/partner/add')
    			->type('1', 'partner_type')
    			->type('boston', 'heading')
    			->type('boston', 'title')
    			->type('boston', 'description')
    			->type('1200', 'target_amount')
    			->type('120z', 'target_donors')
    			->type('admin@nepalrising.org', 'paypal_email')
    			->press('add')
    			->seePageIs('/admin/partner/add');
    }

    /**
    * Check with right values
    *
    * @return void
    */
    public function testCorrectData()
    {
    	$user = factory(App\User::class)->create();
		$this->actingAs($user)
    			->visit('/admin/partner/add')
    			->type('1', 'partner_type')
    			->type('boston', 'heading')
    			->type('boston', 'title')
    			->type('boston', 'description')
    			->type('1200', 'target_amount')
    			->type('120', 'target_donors')
    			->type('admin@nepalrising.org', 'paypal_email')
    			->press('add')
    			->seePageIs('/admin/partners');
    }

    /**
     * check with wrong values change status
     *
     * @return void
     */
    public function testChangeStatus()
    {
        $user = factory(App\User::class)->create();
		$this->actingAs($user)
    		->post('/admin/partner/change-status', ['partner_id' => '0'])
            ->seeJson([
                 'status' => 'error',
             ]);
    }
}
