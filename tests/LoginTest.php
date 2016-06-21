<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
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
    * Check admin login url exists 
    *
    * @return void
    */
    public function testUrl()
    {
    	$response = $this->call('GET', 'admin/login');

    	$this->assertEquals(200, $response->status());
    }

    /**
    * Check with empty form fields
    *
    * @return void
    */
    public function testBlankFields()
    {
    	$this->visit('admin/login')
    			->press('login')
    			->seePageIs('/admin/login');
    }

    /**
    * Check with mis matched values
    *
    * @return void
    */
    public function testMismatchData()
    {
    	$this->visit('/admin/login')
    			->type('admin@nepalrising', 'username')
    			->type('password', 'password')
    			->press('login')
    			->seePageIs('/admin/login');
    }

    public function testCorrectData()
    {
    	$this->visit('/admin/login')
    			->type('admin@nepalrising.org', 'username')
    			->type('password', 'password')
    			->press('login')
    			->seePageIs('/admin/dashboard');
    }
}
