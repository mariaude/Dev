<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PasswordLinksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PasswordLinksTable Test Case
 */
class PasswordLinksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PasswordLinksTable
     */
    public $PasswordLinks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.password_links',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PasswordLinks') ? [] : ['className' => PasswordLinksTable::class];
        $this->PasswordLinks = TableRegistry::getTableLocator()->get('PasswordLinks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PasswordLinks);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
