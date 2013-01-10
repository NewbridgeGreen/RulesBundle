<?php

namespace NewbridgeGreen\RulesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('newbridge_green_rules');

        $rootNode->children()
            ->arrayNode('rule_manager')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('default_database')->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
