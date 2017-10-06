<?php
namespace Mobingi\Core\Factory;
use \InvalidArgumentException;
/**
 * AWS SDK Clients Factory
 * If you use the AWS SDK client, create an instance from this class
 * @package Mobingi\Core\Factory
 */
class AwsSdkClientFactory {
    /**
     * The client list of supported AWS SDK
     * @var array
     */
    private static $SUPPORTED_CLIENT_LIST = [
        'cloudformation' => 'Aws\CloudFormation\CloudFormationClient',
        'ec2'            => 'Aws\Ec2\Ec2Client',
    ];

    /**
     * Create the client of AWS SDK by array options
     * @param string $clientName The target client('autoscaling', 'cloudformation', 'ec2', ...etc)
     * @param array $options Option values
     * @return array|Guzzle\Common\Collection Created the client of AWS SDK
     */
    public function createClient($clientName, array $options) {
        if (!array_key_exists($clientName, self::$SUPPORTED_CLIENT_LIST)) {
            throw new InvalidArgumentException("No such AWS Client Class!!");
        }
        $client = self::$SUPPORTED_CLIENT_LIST[$clientName];
        return $client::factory($options);
    }

    /**
     * Create the list of clients of AWS SDK by array options
     * @param array $clientNameList The list of target clients(['autoscaling', 'cloudformation', 'ec2',...]etc)
     * @param array $options Option values
     * @return array(The target clients('autoscaling', 'cloudformation', 'ec2',...etc) => array|Guzzle\Common\Collection)
     */
    public function createClientList(array $clientNameList, array $options) {
        $clientList = [];
        foreach ($clientNameList as $clientName) {
             $clientList[$clientName] = $this->createClient($clientName, $options);
        }
        return $clientList;
    }

    /**
     * Create the client of AWS SDK by vendor info
     * @param array $clientNameList The list of target clients(['autoscaling', 'cloudformation', 'ec2',...]etc)
     * @param array $options The vendor info(cred, secret, region)
     * @return array(The target clients('autoscaling', 'cloudformation', 'ec2',...etc) => array|Guzzle\Common\Collection)
     */
    public function createClientByVendor(array $clientNameList, array $options) {
        $options["key"] = $options["cred"];
        unset($options["cred"]);
        return $this->createClientList($clientNameList, $options);
    }
}
