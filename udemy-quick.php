<?php
/*
 * Sample application for Udemy client to server authentication.
 * Remember to fill client id and client secret,
 *
 * Copyright 2016 Bloter and Media Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * Include path is still necessary despite autoloading because of the require_once in the libary
 * Client library should be fixed to have correct relative paths
 * e.g. require_once '../Udemy/Model.php'; instead of require_once 'Udemy/Model.php';
 */
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ .'/vendor/udemy/apiclient/src');

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Replace this with the client ID you got from the Udemy API
 */
const CLIENT_ID = 'YOUR_CLIENT_ID';

/**
 * Replace this with the client secret you got from the Udemy API
 */
const CLIENT_SECRET = 'YOUR_CLIENT_SECRET';


/**
 * Optionally replace this with your application's name.
 */
const APPLICATION_NAME = "Udemy PHP Quickstart";

$client = new Udemy_Client();
$client->setApplicationName(APPLICATION_NAME);
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);

$service = new Udemy_Service_Courses($client);

$optParams = array(	'page_size' => 10 );
$results = $service->courses->listCourses($optParams);

foreach ($results as $item) {
	$title = json_decode('"'.$item['title'].'"');
	if( isset($optParams['language']) && $optParams['language'] == 'ko' ){
		echo iconv('UTF-8', 'EUC-KR', $title) . PHP_EOL;
	}
}
