<?php
namespace BKWSU\Component\Sendy\Administrator\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Psr\Container\ContainerInterface;

class SendyComponent extends MVCComponent implements RouterServiceInterface, BootableExtensionInterface
{
    use RouterServiceTrait;
    use HTMLRegistryAwareTrait;

    public function boot(ContainerInterface $container): void
    {
    }
} 