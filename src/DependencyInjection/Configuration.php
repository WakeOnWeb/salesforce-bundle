<?php

namespace WakeOnWeb\SalesforceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $tb       = new TreeBuilder();
        $rootNode = $tb->root('wakeonweb_salesforce');

        $rootNode
            ->children()
                ->scalarNode('host')->isRequired()->end()
                ->scalarNode('version')->isRequired()->end()
                ->arrayNode('oauth')
                    ->isRequired()
                    ->children()
                        ->arrayNode('password_strategy')
                            ->isRequired()
                            ->children()
                                ->scalarNode('consumer_key')->isRequired()->end()
                                ->scalarNode('consumer_secret')->isRequired()->end()
                                ->scalarNode('login')->isRequired()->end()
                                ->scalarNode('password')->isRequired()->end()
                                ->scalarNode('security_token')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ;

        return $tb;
    }
}
