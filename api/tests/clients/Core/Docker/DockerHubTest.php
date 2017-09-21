<?php
namespace MobingiTest\Core\Docker;
use Mobingi\Core\Docker\DockerHub;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Core\Docker\DockerHub
 */
class DockerHubTest extends MobingiApiTestBase {
    /**
     * @override
     * @return Mobingi\Core\Docker\DockerHub
     */
    protected function getTargetInstance() {
        return new Dockerhub();
    }

    /**
     * Test for searchDocker
     */
    function testSearchDocker() {
        // Test execute
        $repo = "Mobingi";
        ob_start();
        $this->target->searchDocker($repo);
        $actual = ob_get_clean();

        // Check the result
        $actual = json_decode($actual, true);
        $this->assertArrayHasKey("num_pages", $actual);
        $this->assertArrayHasKey("num_results", $actual);
        $this->assertArrayHasKey("results", $actual);
        $this->assertArrayHasKey("page_size", $actual);
        $this->assertSame($repo, $actual["query"]);
        $this->assertArrayHasKey("page", $actual);
    }
}
