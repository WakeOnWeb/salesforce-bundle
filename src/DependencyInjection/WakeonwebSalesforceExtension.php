<?php

namespace WakeOnWeb\SalesforceBundle\DependencyInjection;

/* Imports */
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use WakeOnWeb\ServiceBusBundle\Infra\Bernard\Producer;
use WakeOnWeb\ServiceBusBundle\Infra\Bernard\Receiver;
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
