<?php

namespace Tests\WakeOnWeb\SalesforceBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;
use WakeOnWeb\SalesforceBundle\DependencyInjection\Configuration as SUT;

class ConfigurationTest extends TestCase
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     * @expectedExceptionMessage The child node "host" at path "wakeonweb_salesforce" must be configured.
     */
    public function test_with_no_configuration()
    {
        (new Processor())->processConfiguration(new SUT(), []);
    }

    public function test_ok_with_configuration()
    {
        $config = [
            'host' => 'http://domain.tld',
            'version' => 'v1337',
            'oauth' => [
                'password_strategy' => [
                    'consumer_key' => 'vicmkey',
                    'consumer_secret' => 'vicsecret',
                    'login' => 'login',
                    'password' => 'pwd',
                    'security_token' => 'st',
                ],
            ],
        ];

        $this->assertEquals(
            (new Processor())->processConfiguration(new SUT(), [$config]),
            $config
        );
    }
}
