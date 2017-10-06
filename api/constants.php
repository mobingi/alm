<?php
/**
  * Environment variables and constants
  *
  * This file defines a set of constants that stored necessary settings for running Mobingi ALM CE,
  * while some constants are only used in Mobingi ALM EE version but may listed in this file.
  *
  * @author Mobingi Enterprise Team
  */


const AWS_REGION = 'ap-northeast-1'; //used for default region when deploying to AWS

// Supported Cloud Vendors
const VENDOR_KEY_LIST = [
            ['vendor'=>'aws'],
            ['vendor'=>'alicloud']
        ];

/**
  * Below are environment variables and you need to set them up in your server which running this script
  */

// API version
const ENV_API_URL = 'API_URL'; // e.g: "//69.89.31.226/api"

// Alm-Agent Version
const ENV_ALM_AGENT_TAG = 'ALM_AGENT_TAG'; // e.g: set "master" for production Alm-agent, or "develop" for development Alm-agent version

// Directory of Saved Files
const DIR_SAVED_FILES = __DIR__. '/.mobingi';
