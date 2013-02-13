<?php

/**
 * @file
 * Integrates PHPExcel with Silex as a Service Provider.
 * 
 * Based on the Symfony2 bundle code from:
 * https://github.com/liuggio/ExcelBundle
 */

namespace Jaza\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;

use n3b\Bundle\Util\HttpFoundation\StreamResponse\StreamWriterWrapper;
use n3b\Bundle\Util\HttpFoundation\StreamResponse\StreamResponse;

use Jaza\Silex\ExcelContainer;

/**
 * PHPExcel integration for Silex.
 *
 * @author Jeremy Epstein <jazepstein@greenash.net.au>
 */
class ExcelServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['xls.service_xls5'] = $app->share(function ($app) {
            $objPHPExcel = new \PHPExcel();
            $factory = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            
            $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
            
            $streamWriter = new StreamWriterWrapper('php://output');
            $streamWriter->setWriter($factory, 'save');
            return new ExcelContainer($objPHPExcel, $streamWriter, StreamResponse);
        });
    }

    public function boot(Application $app)
    {
    }
}
