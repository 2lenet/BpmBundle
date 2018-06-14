<?php

namespace Lle\BpmBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class LleBpmExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        if ($container->hasParameter('twig.form.resources')) {
            $container->setParameter('twig.form.resources', array_merge(
                ['LleBpmBundle:form:widget.html.twig'],
                $container->getParameter('twig.form.resources')
            ));
        }

        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        $loader->load('form.yaml');
        $loader->load('actions.yaml');

        $configuration = new Configuration();
        $processedConfig =  $this->processConfiguration($configuration, $configs);
    }
}
