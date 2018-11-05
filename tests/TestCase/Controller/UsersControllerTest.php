<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.enterprises',
        'app.students'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
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

        $this->get('/users/add');
        

        $this->assertResponseOk();
        
        $data = [   
            'id' => 2,
                'email' => 'gaga',
                'password' => 'lady',
                'role' => 'student'
            ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post("users/add", $data);
        $this->assertResponseSuccess();
        $users = TableRegistry::get('Users');
        $query = $users->find('all', ['condtions' =>['id' => $data['id']]]);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
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

        $this->get('/users/edit/1');
        

        $this->assertResponseOk();
        
        $data = [   
            'id' => 1,
                'email' => 'gaga',
                'password' => 'lady',
                'role' => 'student'
            ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post("users/edit/1", $data);
        $this->assertResponseSuccess();
        $users = TableRegistry::get('Users');
        $query = $users->find('all', ['condtions' =>['email' => $data['email']]]);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
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

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post("users/delete/1");
        $this->assertResponseSuccess();
        $users = TableRegistry::get('Users');
        $query = $users->find('all', ['condtions' =>['id' => 1]])->first();
        $this->assertEmpty($query);

    }
}
