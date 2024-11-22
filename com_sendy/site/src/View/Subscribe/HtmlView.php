<?php
namespace BKWSU\Component\Sendy\Site\View\Subscribe;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;

class HtmlView extends BaseHtmlView
{
    protected $params;
    protected $state;

    public function display($tpl = null)
    {
        Log::add('HtmlView::display()', Log::DEBUG, 'sendy');

        $app = Factory::getApplication();
        $this->params = $app->getParams();
        $this->state = $this->get('State');

        return parent::display($tpl);
    }
} 