<?php
namespace BKWSU\Component\Sendy\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

class SubscribersModel extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id',
                'name',
                'email',
                'created',
                'status'
            );
        }

        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__sendy_subscribers'));

        // Add search filter
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
            $query->where('(name LIKE ' . $search . ' OR email LIKE ' . $search . ')');
        }

        // Add status filter
        $status = $this->getState('filter.status');
        if (is_numeric($status)) {
            $query->where('status = ' . (int) $status);
        }

        // Add sorting
        $orderCol = $this->state->get('list.ordering', 'created');
        $orderDirn = $this->state->get('list.direction', 'desc');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }
} 