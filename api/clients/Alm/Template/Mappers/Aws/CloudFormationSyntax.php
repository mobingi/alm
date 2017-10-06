<?php
namespace Mobingi\Alm\Template\Mappers\Aws;
/**
 * Template Mappers CloudFormationSyntax
 * @package Mobingi\Alm\Template\Mappers\Aws
 */
class CloudFormationSyntax {

    const MAPPINGS_SYNTAX = [
        "ingress"                       =>  "SecurityGroupIngress",
        "egress"                        =>  "SecurityGroupEgress",
        "cidr"                          =>  "CidrBlock",
        "port_from"                     =>  "FromPort",
        "port_to"                       =>  "ToPort",
        "ip_protocol"                   =>  "IpProtocol",
        "rule_number"                   =>  "RuleNumber",
        "auto_assign_public_ip"         =>  "MapPublicIpOnLaunch"
    ];

}
