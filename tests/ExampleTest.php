<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Nepal Rising');

        $this->visit('/')
         ->click('projects')
         ->seePageIs('/projects');

        $this->visit('/')
         ->click('contact')
         ->seePageIs('/contact');
    }

    public function testContact()
    {
        $this->expectsJobs(App\Jobs\SendEmail::class);

        $this->visit('/contact')
             ->type('Sunil', 'full_name')
             ->type('adhikarysunil.1@gmail.com', 'email_address')
             ->type('Sunil', 'subject')
             ->type('Sunil', 'message')
             ->press('Submit')             
             ->see('submitted successfully');
    }
}
