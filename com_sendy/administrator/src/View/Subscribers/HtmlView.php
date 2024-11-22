<?php
namespace BKWSU\Component\Sendy\Administrator\View\Subscribers;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ContentHelper;
class HtmlView extends BaseHtmlView
{
    protected $items;
    // protected $pagination;
    // protected $state;
    // protected $filterForm;
    // protected $activeFilters;

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        if (count($errors = $this->get('Errors'))) {
            throw new \Exception(implode("\n", $errors), 500);
        }

        $this->addToolbar();

        return parent::display($tpl);
    }

    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('COM_SENDY_SUBSCRIBERS_MANAGER'), 'users');
        ToolbarHelper::deleteList('', 'subscribers.delete');
        ToolbarHelper::preferences('com_sendy');

        $canDo = ContentHelper::getActions('com_sendy');

        if ($canDo->get('core.delete')) {
            ToolbarHelper::deleteList('', 'subscribers.delete');
        }
    }
} 