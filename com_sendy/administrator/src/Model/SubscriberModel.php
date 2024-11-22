<?php
namespace BKWSU\Component\Sendy\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class SubscriberModel extends AdminModel
{
    public $typeAlias = 'com_sendy.subscriber';

    protected function canDelete($record)
    {
        return Factory::getApplication()->getIdentity()->authorise('core.delete', 'com_sendy');
    }

    public function getTable($name = 'Subscriber', $prefix = 'Table', $options = [])
    {
        return parent::getTable($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_sendy.subscriber',
            'subscriber',
            array('control' => 'jform', 'load_data' => $loadData)
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }
} 