<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Wireless;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\Preview\Wireless\Device\UsageList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Preview\Wireless\Device\UsageList usage
 * @method \Twilio\Rest\Preview\Wireless\Device\UsageContext usage()
 */
class DeviceContext extends InstanceContext {
    protected $_usage = null;

    /**
     * Initialize the DeviceContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $sid The sid
     * @return \Twilio\Rest\Preview\Wireless\DeviceContext 
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);
        
        // Path Solution
        $this->solution = array(
            'sid' => $sid,
        );
        
        $this->uri = '/Devices/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a DeviceInstance
     * 
     * @return DeviceInstance Fetched DeviceInstance
     */
    public function fetch() {
        $params = Values::of(array());
        
        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );
        
        return new DeviceInstance(
            $this->version,
            $payload,
            $this->solution['sid']
        );
    }

    /**
     * Update the DeviceInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return DeviceInstance Updated DeviceInstance
     */
    public function update($options = array()) {
        $options = new Values($options);
        
        $data = Values::of(array(
            'Alias' => $options['alias'],
            'CallbackMethod' => $options['callbackMethod'],
            'CallbackUrl' => $options['callbackUrl'],
            'FriendlyName' => $options['friendlyName'],
            'SimIdentifier' => $options['simIdentifier'],
            'Status' => $options['status'],
            'CommandsCallbackMethod' => $options['commandsCallbackMethod'],
            'CommandsCallbackUrl' => $options['commandsCallbackUrl'],
        ));
        
        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );
        
        return new DeviceInstance(
            $this->version,
            $payload,
            $this->solution['sid']
        );
    }

    /**
     * Access the usage
     * 
     * @return \Twilio\Rest\Preview\Wireless\Device\UsageList 
     */
    protected function getUsage() {
        if (!$this->_usage) {
            $this->_usage = new UsageList(
                $this->version,
                $this->solution['sid']
            );
        }
        
        return $this->_usage;
    }

    /**
     * Magic getter to lazy load subresources
     * 
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     * 
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }
        
        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.Wireless.DeviceContext ' . implode(' ', $context) . ']';
    }
}