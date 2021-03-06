<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

umask(0);

$mtfRoot = dirname(dirname(__DIR__));
$mtfRoot = str_replace('\\', '/', $mtfRoot);
define('MTF_BP', $mtfRoot);

include_once $mtfRoot . '/bootstrap.php';

$path = get_include_path();
$path = rtrim($path, PATH_SEPARATOR);
$path .= PATH_SEPARATOR . MTF_BP;
$path .= PATH_SEPARATOR . MTF_BP . '/lib';
set_include_path($path);

$objectManager = \Mtf\ObjectManagerFactory::getObjectManager();
/** @var $generate \Mtf\Util\Generate\Fixture */
$generate = $objectManager->get('Mtf\Util\Generate\Fixture');
$generate->launch();

\Mtf\Util\Generate\GenerateResult::displayResults();
