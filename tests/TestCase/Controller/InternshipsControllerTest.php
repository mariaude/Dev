<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InternshipsController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\InternshipsController Test Case
 */
class InternshipsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.internships',
        'app.enterprises',
        'app.users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/pages');

        $this->assertResponseOk();
        //$this->markTestIncomplete('Not implemented yet.');
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

        $this->get('/internships/view/1');
        
        $this->assertResponseOk();
        //$this->markTestIncomplete('Not implemented yet.');
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

        $this->get('/internships/add');
        

        $this->assertResponseOk();
        
        $data = [   
                'id' => 2,
                'enterprise_id' => 1,
                'semester' => 'bob',
                'start_date' => '2019-10-22',
                'end_date' => '2019-10-22',
                'available_places' => 10,
                'work_hours' => 'Lorem ipsum dolor sit amet',
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post("internships/add", $data);
        $this->assertResponseSuccess();
        $internships = TableRegistry::get('Internships');
        $query = $internships->find('all', ['condtions' =>['id' => $data['id']]]);
        $this->assertEquals(1, $query->count());
        //$this->markTestIncomplete('Not implemented yet.');
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

        $this->get('/internships/edit/1');
        

        $this->assertResponseOk();
        
        $data = [   
                'id' => 1,
                'enterprise_id' => 1,
                'semester' => 'tony',
                'start_date' => '2019-10-22',
                'end_date' => '2019-10-22',
                'available_places' => 10,
                'work_hours' => 'Lorem ipsum dolor sit amet',
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post("internships/edit/1", $data);
        $this->assertResponseSuccess();
        $internships = TableRegistry::get('Internships');
        $query = $internships->find('all', ['condtions' =>['semester' => $data['semester']]]);
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
        $this->post("internships/delete/1");
        $this->assertResponseSuccess();
        $internships = TableRegistry::get('Internships');
        $query = $internships->find('all', ['condtions' =>['id' => ['id' => 1]]])->first();
        $this->assertEmpty($query);

    }
}
