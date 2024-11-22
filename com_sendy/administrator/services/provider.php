<?php

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use BKWSU\Component\Sendy\Administrator\Extension\SendyComponent;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\Component\Router\RouterFactoryInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container->registerServiceProvider(new MVCFactory('\\BKWSU\\Component\\Sendy'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\BKWSU\\Component\\Sendy'));
        $container->registerServiceProvider(new RouterFactory('\\BKWSU\\Component\\Sendy'));
        $container->registerServiceProvider(new CategoryFactory('\\BKWSU\\Component\\Sendy'));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new SendyComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));

                return $component;
            }
        );
    }
}; 