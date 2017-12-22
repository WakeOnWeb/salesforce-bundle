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
                ->scalarNode('host')->cannotBeEmpty()->isRequired()->end()
                ->scalarNode('version')->cannotBeEmpty()->isRequired()->end()
                ->arrayNode('oauth')
                    ->isRequired()
                    ->children()
                        ->arrayNode('password_strategy')
                            ->isRequired()
                            ->children()
                                ->scalarNode('consumer_key')->cannotBeEmpty()->isRequired()->end()
                                ->scalarNode('consumer_secret')->cannotBeEmpty()->isRequired()->end()
                                ->scalarNode('login')->cannotBeEmpty()->isRequired()->end()
                                ->scalarNode('password')->cannotBeEmpty()->isRequired()->end()
                                ->scalarNode('security_token')->cannotBeEmpty()->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ;

        return $tb;
    }
}
