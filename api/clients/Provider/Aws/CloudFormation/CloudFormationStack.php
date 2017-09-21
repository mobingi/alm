<?php
namespace Mobingi\Provider\Aws\CloudFormation;
use Mobingi\Alm\Stack\StackProviderInterface;
use Mobingi\Alm\Stack\Traits\StackTrait;
use Mobingi\Core\ClientBase;
/**
 * CloudFormation Stack Provider Client
 * @package Mobingi\Provider\Aws\CloudFormation
 */
class CloudFormationStack extends ClientBase implements StackProviderInterface {
    /**
     * Consts
     */
    const ARN_NAME_STACK = "ALM-STACK-V3";
    const ARN_NAME_INSTANCE = "ALM-INSTANCE-V3";
    const DEFAULT_OPTIONS = ['DryRun' => false];

    /**
     * Traits
     */
    use StackTrait;

    /**
     * {@inheritdoc}
     */
    protected function initClients() {}

    /**
     * @override
     * @see Mobingi\Alm\Stack\StackProviderInterface::addDescribeItem
     */
    public function addDescribeItem($stack_id, array $item) {
        extract($this->awsSdkFactory->createClientByVendor(['ec2'], $this->getVendorByStackInfo($item, "aws")));
        $result = $ec2->describeInstances(self::DEFAULT_OPTIONS + ['Filters' => [['Name' => 'tag:Stack_Name', 'Values' => [$value]]]])->toArray();
        $item['instances'] = array_column(array_column($result['Reservations'], 'Instances'), 0);
        return $item;
    }

    const CREATE_STACK_PARAMS = ['TimeoutInMinutes' => 120, 'OnFailure' => 'DO_NOTHING', 'Capabilities' => ['CAPABILITY_IAM']];
    /**
     * @override
     * @see Mobingi\Alm\Stack\StackProviderInterface::createProcess
     */
    public function createProcess($stack_id, array $vendor, $template) {
        $tags = [['Key' => 'Stack_Name', 'Value' => $stack_id]];
        $options = $this->getCFOptions($stack_id, $vendor, $template) + self::CREATE_STACK_PARAMS + ['Tags' => $tags];
        extract($this->awsSdkFactory->createClientByVendor(['cloudformation'], $vendor));
        $cloudformation->createStack($options);
    }

    const UPDATE_STACK_PARAMS = ['UsePreviousTemplate' => false];
    /**
     * @override
     * @see Mobingi\Alm\Stack\StackProviderInterface::updateProcess
     */
    public function updateProcess($stack_id, array $vendor, $template) {
        extract($this->awsSdkFactory->createClientByVendor(['cloudformation'], $vendor));
        $options = $this->getCFOptions($stack_id, $vendor, $template) + self::UPDATE_STACK_PARAMS;
        $cloudformation->updateStack($options);
    }

    /**
     * @override
     * @see Mobingi\Alm\Stack\StackProviderInterface::deleteProcess
     */
    public function deleteProcess($stack_id, array $vendor) {
        extract($this->awsSdkFactory->createClientByVendor(['cloudformation', "ec2"], $vendor));
        $cloudformation->deleteStack(['StackName' => $stack_id]);
        $ec2->deleteKeyPair(self::DEFAULT_OPTIONS + ['KeyName' => $stack_id]);
    }

    /**
     * Get Cloud Formation Options
     * @param string $stack_id StackID
     * @param array $vendor The vendor info(cred, secret, region)
     * @param object $template Converted Template Body
     * @return Cloud Formation Options
     */
    private function getCFOptions($stack_id, array $vendor, $template) {
        return ['StackName' => $stack_id, 'TemplateBody' => json_encode($template)];
    }

}
