<?php
namespace Mobingi\Alm\Template\Mappers\Aws;
/**
 * Template Mappers CloudFormationParameters
 * @package Mobingi\Alm\Template\Mappers\Aws
 */
class CloudFormationParameters {


    const MAPPINGS_PARAM = [

        "APIHost" => [
            "Description" => "DockerLayer.APIHost",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "InstanceType" =>[
            "Default" => "t2.micro",
            "Description" => "DockerLayer.InstanceType",
            "Type" => "String"
        ],
        "AccessKey" => [
            "Description" => "DockerLayer.AccessKey",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "AssociatePublicIP" => [
            "Default" => "true",
            "Description" => "DockerLayer.AssociatePublicIP",
            "Type" => "String"
        ],
        "AuthorizationToken" => [
            "Default" => "",
            "Description" => "DockerLayer.AuthorizationToken",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "AutoscalingNotificationARN" => [
            "Description" => "DockerLayer.AutoscalingNotificationARN",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "CertificateName" => [
            "Default" => "",
            "Description" => "DockerLayer.CertificateName",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "CloudfrontCache" => [
            "Default" => "false",
            "Description" => "DockerLayer.CloudfrontCache",
            "Type" => "String"
        ],
        "DBAllocatedStorage" => [
            "Default" => 10,
            "Description" => "DockerLayer.DBAllocatedStorage",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "DBEngine" => [
            "Default" => "MySQL",
            "Description" => "DockerLayer.DBEngine",
            "Type" => "String"
        ],
        "DBInstanceType" => [
            "Default" => "Db.t2.micro",
            "Description" => "DockerLayer.DBInstanceType",
            "Type" => "String"
        ],
        "DBIsPublic" => [
            "Default" => "false",
            "Description" => "DockerLayer.DBIsPublic",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "DBName" => [
            "Default" => "Default",
            "Description" => "DockerLayer.DBName",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "DBPassword" => [
            "Default" => "changethis",
            "Description" => "DockerLayer.DBPassword",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "DBSnapshot" => [
            "Default" => "",
            "Description" => "DockerLayer.DBSnapshot",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "DBStorageType" => [
            "Default" => "gp2",
            "Description" => "DockerLayer.DBStorageType",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "DBUsername" => [
            "Default" => "changethis",
            "Description" => "DockerLayer.DBUsername",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ElastiCacheEngine" => [
            "Default" => "",
            "Description" => "DockerLayer.ElastiCacheEngine",
            "Type" => "String"
        ],
        "ElastiCacheGroupName" => [
            "Default" => "",
            "Description" => "DockerLayer.ElastiCacheGroupName",
            "Type" => "String"
        ],
        "ElastiCacheNodeType" => [
            "Default" => "cache.t2.micro",
            "Description" => "DockerLayer.ElastiCacheNodeType",
            "Type" => "String"
        ],
        "ElastiCacheNodes" => [
            "Default" => 0,
            "Description" => "DockerLayer.ElastiCacheNodes",
            "Type" => "Number"
        ],
        "ELBOpen80Port" => [
            "Default" => "true",
            "Description" => "DockerLayer.ELBOpen80Port",
            "Type" => "String"
        ],
        "ELBOpen443Port" => [
            "Default" => "true",
            "Description" => "DockerLayer.ELBOpen443Port",
            "Type" => "String"
        ],
        "HasElastiCache" => [
            "Default" => "false",
            "Description" => "DockerLayer.HasElastiCache",
            "Type" => "String"
        ],
        "HasRDSDatabase" => [
            "Default" => "false",
            "Description" => "DockerLayer.HasRDSDatabase",
            "Type" => "String"
        ],
        "HideAWSFromContainers" => [
            "Default" => "false",
            "Description" => "DockerLayer.HideAWSFromContainers",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "HostedZone" => [
            "Default" => "",
            "Description" => "DockerLayer.HostedZone",
            "Type" => "String"
        ],
        "KeyPairName" => [
            "Description" => "DockerLayer.KeyPairName",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "LogBucket" => [
            "Default" => "mocloud-customers",
            "Description" => "DockerLayer.LogBucket",
            "Type" => "String"
        ],
        "MachineVolumeSize" => [
            "Default" => 30,
            "Description" => "DockerLayer.MachineVolumeSize",
            "Type" => "Number"
        ],
        "MachineVolumeType" => [
            "Default" => "gp2",
            "Description" => "DockerLayer.MachineVolumeType",
            "Type" => "String"
        ],
        "ManagementServerType" => [
            "Default" => "t2.micro",
            "Description" => "DockerLayer.ManagementServerType",
            "Type" => "String"
        ],
        "MaxSize" => [
            "Default" => 10,
            "Description" => "DockerLayer.MaxSize",
            "Type" => "Number"
        ],
        "MinSize" => [
            "Default" => 1,
            "Description" => "DockerLayer.MinSize",
            "Type" => "Number"
        ],
        "SpotInstanceMaxSize" => [
            "Default" => 0,
            "Description" => "DockerLayer.MaxSize",
            "Type" => "Number"
        ],
        "SpotInstanceMinSize" => [
            "Default" => 0,
            "Description" => "DockerLayer.MinSize",
            "Type" => "Number"
        ],
        "ModaemonTag" => [
            "Default" => "production",
            "Description" => "DockerLayer.ModaemonTag",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ReadReplica1" => [
            "Default" => "false",
            "Description" => "DockerLayer.ReadReplica1",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ReadReplica2" => [
            "Default" => "false",
            "Description" => "DockerLayer.ReadReplica2",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ReadReplica3" => [
            "Default" => "false",
            "Description" => "DockerLayer.ReadReplica3",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ReadReplica4" => [
            "Default" => "false",
            "Description" => "DockerLayer.ReadReplica4",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ReadReplica5" => [
            "Default" => "false",
            "Description" => "DockerLayer.ReadReplica5",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "SecretKey" => [
            "Description" => "DockerLayer.SecretKey",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ServerConfigApiEndpoint" => [
            "Description" => "DockerLayer.ServerConfigLocation",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "ServerRole" => [
            "Default" => "",
            "Description" => "DockerLayer.ServerRole",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "SpotPrice" => [
            "Default" => "",
            "Description" => "DockerLayer.SpotPrice",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "StackId" => [
            "Description" => "DockerLayer.StackId",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "StorageService" => [
            "Default" => "S3",
            "Description" => "DockerLayer.StorageService",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "UserId" => [
            "Description" => "DockerLayer.UserId",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "WebserverName" => [
            "Default" => "",
            "Description" => "DockerLayer.WebserverName",
            "Type" => "String"
        ],
        "Zone1" => [
            "Description" => "DockerLayer.Zone1",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "Zone2" => [
            "Default" => "",
            "Description" => "DockerLayer.Zone2",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "Zone3" => [
            "Default" => "",
            "Description" => "DockerLayer.Zone3",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "Zone4" => [
            "Default" => "",
            "Description" => "DockerLayer.Zone4",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "Zone5" => [
            "Default" => "",
            "Description" => "DockerLayer.Zone5",
            "NoEcho" => "true",
            "Type" => "String"
        ],
        "Zone6" => [
            "Default" => "",
            "Description" => "DockerLayer.Zone6",
            "NoEcho" => "true",
            "Type" => "String"
        ]


    ];



}
