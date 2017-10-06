<?php
namespace MobingiTest\Core\Utility;
use Mobingi\Core\Utility\Common;
use \DateTime;
use \MobingiApiTestBase;
/**
 * Test Case for Mobingi\Core\Utility\Common
 */
class CommonTest extends MobingiApiTestBase {
    /**
     * @override
     * @return null(Because static class)
     */
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test for generateToken
     * @dataProvider getProvidorGenerateToken
     * @param int $num The length to generate token
     * @param int $expectedLength length to expected generate token
     */
    function testGenerateToken($num, $expectedLength) {
        $actual = Common::generateToken($num);
        $this->assertLessThanOrEqual($expectedLength, strlen($actual));
        $this->assertNotEmpty($actual);
    }

    /**
     * Test Providor for generateToken
     * @return array The list of Test Parameters
     */
    function getProvidorGenerateToken() {
	    return [
            [16,   16],
            [null, 9],
        ];
    }

    /**
     * Test for getUserIDByStackID
     * @dataProvider getProvidorGetUserIDByStackID
     * @param string $stackId StackID
     * @param string $expected Expected value
     */
    function testGetUserIDByStackID($stackId, $expected) {
        $actual = Common::getUserIDByStackID($stackId);
        $this->assertSame($expected, $actual);
    }

    /**
     * Test Providor for getUserIDByStackID
     * @return array The list of Test Parameters
     */
    function getProvidorGetUserIDByStackID() {
        $stackId = getenv(TEST_STACK_ID);
        return [
            [$stackId, explode('-', $stackId)[1]],
            ["ap---", ""],
        ];
    }

    /**
     * Test for getInfoByToken
     */
    function testGetInfoByToken() {
        $actual = Common::getInfoByToken();
        $this->assertInternalType("array", $actual);
        $this->assertSame($this->getUserId(), $actual["user_id"]);
    }

    /**
     * Test for getInfoByStackId
     * @dataProvider getProvidorGetInfoByStackId
     * @param string $stack_id StackID (ex:k5-5447826c870e7-Y6CUi314b-tk)
     * @param array  $expected Expected value('user_id' => UserID, 'region' => Region Name)
     */
    function testGetInfoByStackId($stack_id, $expected) {
         $actual = Common::getInfoByStackId($stack_id);
         $this->assertSame($expected, $actual);
    }

    /**
     * Test Providor for getRegionNickname
     * @return array The list of Test Parameters
     */
    function getProvidorGetInfoByStackId() {
        $user_id = '1a2b3c4d5e6f';
        $stack_id = "mo-{$user_id}-xiqspr-tk";
        return [
            [$stack_id, ['user_id' => $user_id, 'region' => 'ap-northeast-1']],
            [str_replace('-tk','-nv', $stack_id), ['user_id' => $user_id, 'region' => 'us-east-1']],
            [str_replace('-tk','-nc', $stack_id), ['user_id' => $user_id, 'region' => 'us-west-1']],
            [str_replace('-tk','-aa', $stack_id), ['user_id' => $user_id, 'region' => 'ap-northeast-1']],
        ];
    }

    /**
     * Test for getRegionNickname
     * @dataProvider getProvidorGetRegionNickname
     * @param string $region Region
     * @param mixed $expected Expected value
     */
    function testGetRegionNickname($region, $expected) {
        $actual = Common::getRegionNickname($region);
        $this->assertSame($expected, $actual);
    }

    /*
     * Test Providor for getRegionNickname
     * @return array The list of Test Parameters
     */
    function getProvidorGetRegionNickname() {
        return [
            ['ap-northeast-1', 'tk'],
            ['us-east-1', 'nv'],
            ['us-west-1', 'nc'],
            ['cn-north-1', 'bj'],
            [null, 'tk'],
        ];
    }

    /**
     * Test for generateNickname
     */
    function testGenerateNickname() {
        // execute and convert the result
        $actual = Common::generateNickname();
        $actual = explode(' ', $actual);
        $fileDir = dirname(__FILE__) . "/";
        $fileDir = str_replace("tests/", "", $fileDir);
        $expected = [
            $fileDir. "random_a.txt",
            $fileDir. "random_b.txt",
            $fileDir. "random_c.txt",
        ];

        // check the result
        foreach ($actual as $key => $value) {
            $lines = file($expected[$key]);
            $this->assertTrue(in_array($value . "\n", $lines));
        }
    }

    /**
     * Test for getDateTime
     */
    function testGetDateTime() {
         $actual = Common::getDateTime();
         $this->assertInternalType("string", $actual);
    }
}
