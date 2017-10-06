<?php
namespace Mobingi\Core\Docker;
use Mobingi\Core\ClientBase;
/**
 * Docker Client
 * @package Mobingi\Core\Docker
 */
class DockerHub extends ClientBase {
    /**
     * @override
     * NOP
     */
    protected function initClients() {}

    function searchDocker($repo){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://index.docker.io/v1/search?q=".$repo);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
