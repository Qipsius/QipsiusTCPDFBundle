<?php

namespace Qipsius\TCPDFBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class QipsiusTCPDFExtension extends Extension
{
    /**
     * Load our configuration.
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('qipsius_tcpdf.file', $config['file']);
        $container->setParameter('qipsius_tcpdf.class', $config['class']);
        $container->setParameter('qipsius_tcpdf.tcpdf', $config['tcpdf']);

        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.php');
    }
}
