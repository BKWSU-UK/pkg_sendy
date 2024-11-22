<?php
namespace BKWSU\Component\Sendy\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Component\ComponentHelper;

class Router extends RouterView
{
    protected $categoryFactory;
    protected $db;
    protected $noids = false;

    public function __construct(SiteApplication $app, AbstractMenu $menu, CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
    {
        Log::add('Router::__construct()', Log::DEBUG, 'sendy');
        $this->categoryFactory = $categoryFactory;
        $this->db = $db;

        $params = ComponentHelper::getParams('com_sendy');
        $this->noids = (bool) $params->get('sef_ids', 0);

        $subscribe = new RouterViewConfiguration('subscribe');
        $this->registerView($subscribe);

        parent::__construct($app, $menu);

        $this->attachRule(new MenuRules($this));
        $this->attachRule(new StandardRules($this));
        $this->attachRule(new NomenuRules($this));
    }
} 