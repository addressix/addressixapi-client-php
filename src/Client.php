<?php
/*
 * Copyright 2016 Meworla GmbH.
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
namespace AddressixAPI;

class Client 
{
	private $auth;
	
	public function __construct(array $config = array())
	{
		$this->options['endpoint'] = isset($config['endpoint']) ? $config['endpoint'] : 'https://www.addressix.com/api';
		$this->options['verifyssl'] = isset($config['verifypeer']) ? $config['verifypeer'] : true;	
    $valid_options = array('clientid','secret','redirect_uri');
    foreach($valid_options as $opt) {
      if (isset($config[$opt])) $this->options[$opt] = $config[$opt];
    }
	}
		
	public function getConfig($key, $default = false)
	{
		if (isset($this->options[$key])) {
			return $this->options[$key];
		} else {
			return $default;
		}
	}
  
  public function getBaseURI()
  {
    return $this->options['endpoint'];
  }
  
	public function getAuth()
	{
		if (!isset($this->auth)) {      
			$this->auth = new \AddressixAPI\Auth\OAuth2($this);
		}
		return $this->auth;	
  }
  
  public function getRequest()
  {
    if (!isset($this->request)) {
      $this->request = new \AddressixAPI\Http\Request($this);
    }
    return $this->request;
  }
}