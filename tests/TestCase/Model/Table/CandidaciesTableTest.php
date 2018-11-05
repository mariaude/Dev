<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidaciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidaciesTable Test Case
 */
class CandidaciesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidaciesTable
     */
    public $Candidacies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.candidacies',
        'app.internships',
        'app.students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Candidacies') ? [] : ['className' => CandidaciesTable::class];
        $this->Candidacies = TableRegistry::getTableLocator()->get('Candidacies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidacies);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
