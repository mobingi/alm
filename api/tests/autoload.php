<?php
// Set minimun memory size
ini_set('memory_limit', '512M');
require "../autoload.php";
require "MobingiApiTestBase.php";

// Mock for test
require 'mock/clients/Core/ClientBaseMock.php';
require 'mock/clients/Alm/Template/Traits/WebHookTraitMock.php';
require 'mock/clients/Alm/Template/TemplateMock.php';

