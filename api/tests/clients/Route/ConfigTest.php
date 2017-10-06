<?php
namespace MobingiTest\Route;
use \MobingiApiTestBase;
use Mobingi\Route\Config;
/**
 * Test Case for MobingiTest\Route\Config
 * @package MobingiTest\Route\Config
 */
class ConfigTest extends MobingiApiTestBase {
    /**
     * @override
     * @return Mobingi\Route\Config
     */
    protected function getTargetInstance() {
        return null;
    }

    /**
     * Test for Routing.yaml check
     */
    function testRoutingYaml() {
        $actual = Config::getServiceRoutingFormat();
        $this->assertArrayHasKey('default_config',$actual);
    }
    /**
     * Test for Routing.yaml default_config
     *      middleware:
     *        header: true
     *        rbac: false
     *        tokeninfo: true
     *        tokenvalidate: true
     */
    function testRoutingYamlConfig() {
        $actual = Config::getServiceRoutingFormat();
        $this->assertArrayHasKey('middleware',$actual['default_config']);
        $this->assertArrayHasKey('header',$actual['default_config']['middleware']);
    }

    /**
     * Test for Routing.yaml endpoint format
     *      [method]:[urlpath]
     *        method: get,post,put,delete
     *        urlpath: /hoge/hoge/{filed}/hoge/{filed}
     *  and settings check
     */
    function testRoutingYamlConfigRoutingEndpoint() {
        $actual = Config::getServiceRoutingFormat();
        unset($actual['default_config']);

        $endpoints = [];
        $actions = [];
        foreach($actual as $endpoint=>$settings){
            $endpoints[$endpoint] = $settings['action'];
            if (is_array($settings['action'])) {
                foreach ($settings['action'] as $act) {
                    $actions[$act] = $endpoint;
                }

            }else{
                $actions[$settings['action']] = $endpoint;
            }

            $this->assertStringMatchesFormat('%s:%e%s',$endpoint);
            $this->assertArrayHasKey('action',$settings);
            $this->assertArrayHasKey('client',$settings);

            $method = explode(':',$endpoint);
            $checkmethod = ['get','post','put','delete'];

            $this->assertCount(2,$method);
            $this->assertContains($method[0],$checkmethod);

            $url= explode('/',$method[1]);
            foreach($url as $pathfield){
                $this->assertStringMatchesFormat('%S',$pathfield);
                //check path string or param format
                preg_match('/\{\w*\}/', $pathfield, $m);
                if($m){
                    $this->assertSame($pathfield,$m[0]);

                }else {
                    preg_match('/\w*/', $pathfield, $p);
                    if($p){
                        $this->assertSame($pathfield,$p[0]);

                    }

                }
            }

            if(in_array($method[0],['post','put','delete'])){
                // if has params, null or array
                if (isset($settings['params'])) {
                    if ($settings['params']) {
                        $this->assertArrayHasKey('params',$settings);    
                    }

                }
            }



        }

        // endpoint map action check
        $e2a_count = 0;
        foreach ($endpoints as $e => $act) {
            if (is_array($act)) {
                foreach($act as $a) {
                    $this->assertSame($actions[$a],$e);
                    $e2a_count++;

                }

            }else{
                $e2a_count++;

            }
        }
        $this->assertSame($e2a_count,count($actions));

    }
}
