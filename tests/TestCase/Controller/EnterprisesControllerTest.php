<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EnterprisesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EnterprisesController Test Case
 */
class EnterprisesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.enterprises',
        'app.users',
        'app.internships'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'email' => 'bob',
                    'password' => 'bob',
                    'role' => 'admin'
                ]
            ]
        ]);

        $this->get('/enterprises');

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'email' => 'bob',
                    'password' => 'bob',
                    'role' => 'admin'
                ]
            ]
        ]);

        $this->get('/enterprises/view/1');
        
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
