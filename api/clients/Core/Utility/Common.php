<?php
namespace Mobingi\Core\Utility;
use \DateTime;
/**
 * Common Utility
 * This class is the logic for no used AWS SDK Clients.
 * @package Mobingi\Core\Utility
 */
class Common {
    const TOEKN_LENGTH = 9;
    const TOKEN_VALID = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Generate Token
     * @param int $num Token Length
     * @return string Generated Token
     */
    static function generateToken($num = null) {
        $length = ($num)? $num : self::TOEKN_LENGTH;
        return self::generateString($length, self::TOKEN_VALID);
    }

    private static function generateString($length, $validValues) {
        $string = '';
        for ($p = 0; $p < $length; $p++) {
            $string .= $validValues[mt_rand(0, strlen($validValues))];
        }
        return $string;
    }

    // abstract user_id from stack_id
    static function getUserIdByStackId($stack_id) {
        return self::getInfoByStackId($stack_id)['user_id'];
    }

    // abstract user_id and username from access_token, in format of 5478246ab870e7[.bloomberg]
    static function getInfoByToken(){
        $return = [];
        if (defined('OAUTH_USER_ID')) {
            $pieces = explode('.', OAUTH_USER_ID);
            $return['user_id'] = $pieces[0];
        }
        return $return;
    }

    /**
     * Get abstract info from stack_id
     * @param string $stack_id StackID (ex:k5-5447826c870e7-Y6CUi314b-tk)
     * @param array('user_id' => UserID, 'region' => Region Name)
     */
    static function getInfoByStackId($stack_id) {
        $pieces = explode('-', $stack_id);
        $nickNames = array_flip(self::REGION_NICKNAMES);
        $region = !empty($nickNames[$pieces[3]])? $nickNames[$pieces[3]] : AWS_REGION;
        return ['user_id' => $pieces[1], "region" => $region];
    }

    const REGION_NICKNAMES = [
        'ap-northeast-1' => 'tk',
        'ap-northeast-2' => 'kr',
        'us-east-1'      => 'nv',
        'us-west-1'      => 'nc',
        'cn-north-1'     => 'bj',
    ];

    static function getRegionNickname($region){
        if (empty(self::REGION_NICKNAMES[$region])) $region = AWS_REGION;
        return self::REGION_NICKNAMES[$region];
    }

    const NICK_NAME_FILES = ["random_a.txt", "random_b.txt", "random_c.txt"];
    static function generateNickname() {
        $fileDir = dirname(__FILE__) . "/";
        $nickNames = [];
        foreach (self::NICK_NAME_FILES as $fileName) {
            $lines = file($fileDir. $fileName);
            $nickNames[] = rtrim($lines[array_rand($lines)]);
        }
        return implode(' ', $nickNames);
    }

    /**
     * Get DateTime
     * @param $format int Default is DateTime::ATOM
     * @return int Formatted DateTime
     */
    static function getDateTime($format = DateTime::ATOM) {
        $time = new DateTime;
        return $time->format($format);
    }
}
