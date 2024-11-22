<?php
namespace BKWSU\Component\Sendy\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class SubscribersController extends AdminController
{
    protected $text_prefix = 'COM_SENDY';

    public function getModel($name = 'Subscriber', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
} 