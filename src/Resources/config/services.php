<?php

use Qipsius\TCPDFBundle\Controller\TCPDFController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('qipsius.tcpdf', TCPDFController::class)
        ->file('%qipsius_tcpdf.file%')
        ->args(['%qipsius_tcpdf.class%']);
};
