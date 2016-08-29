<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Sync\Service;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Version;

/**
 * @property string sid
 * @property string uniqueName
 * @property string accountSid
 * @property string serviceSid
 * @property string url
 * @property string links
 * @property string revision
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string createdBy
 */
class SyncListInstance extends InstanceResource {
    protected $_syncListItems = null;

    /**
     * Initialize the SyncListInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The service_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Preview\Sync\Service\SyncListInstance 
     */
    public function __construct(Version $version, array $payload, $serviceSid, $sid = null) {
        parent::__construct($version);
        
        // Marshaled Properties
        $this->properties = array(
            'sid' => $payload['sid'],
            'uniqueName' => $payload['unique_name'],
            'accountSid' => $payload['account_sid'],
            'serviceSid' => $payload['service_sid'],
            'url' => $payload['url'],
            'links' => $payload['links'],
            'revision' => $payload['revision'],
            'dateCreated' => Deserialize::iso8601DateTime($payload['date_created']),
            'dateUpdated' => Deserialize::iso8601DateTime($payload['date_updated']),
            'createdBy' => $payload['created_by'],
        );
        
        $this->solution = array(
            'serviceSid' => $serviceSid,
            'sid' => $sid ?: $this->properties['sid'],
        );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Preview\Sync\Service\SyncListContext Context for this
     *                                                           SyncListInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new SyncListContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }
        
        return $this->context;
    }

    /**
     * Fetch a SyncListInstance
     * 
     * @return SyncListInstance Fetched SyncListInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the SyncListInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Access the syncListItems
     * 
     * @return \Twilio\Rest\Preview\Sync\Service\SyncList\SyncListItemList 
     */
    protected function getSyncListItems() {
        return $this->proxy()->syncListItems;
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Preview.Sync.SyncListInstance ' . implode(' ', $context) . ']';
    }
}