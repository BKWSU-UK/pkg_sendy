<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'mod_sendy/subscribe.js', ['version' => 'auto', 'relative' => true]);

require ModuleHelper::getLayoutPath('mod_sendy', $params->get('layout', 'default')); 