<?php
namespace BKWSU\Component\Sendy\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class SubscriberTable extends Table
{
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__sendy_subscribers', 'id', $db);
    }
} 