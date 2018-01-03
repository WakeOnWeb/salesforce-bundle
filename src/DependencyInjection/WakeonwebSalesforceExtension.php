<?php

namespace WakeOnWeb\SalesforceBundle\DependencyInjection;

/* Imports */
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use WakeOnWeb\SalesforceClient\REST\Gateway;
use WakeOnWeb\SalesforceClient\REST\Client;
use WakeOnWeb\SalesforceClient\REST\GrantType\PasswordStrategy;

class WakeonwebSalesforceExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = (new Processor())->processConfiguration(new Configuration(), $configs);

        $authStrategyConfig = $config['oauth']['password_strategy'];

        $gatewayDefinition = new Definition(Gateway::class, [$config['host'], $config['version']]);
        $authDefinition = new Definition(PasswordStrategy::class, [
            $authStrategyConfig['consumer_key'],
            $authStrategyConfig['consumer_secret'],
            $authStrategyConfig['login'],
            $authStrategyConfig['password'],
            $authStrategyConfig['security_token'],
        ]);

        $container->setDefinition('wow.salesforce.client', new Definition(Client::class, [$gatewayDefinition, $authDefinition]));
    }
}
