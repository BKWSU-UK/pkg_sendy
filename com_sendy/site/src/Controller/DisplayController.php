<?php
namespace BKWSU\Component\Sendy\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Log\Log;

class DisplayController extends BaseController
{
    /**
     * Default display method
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   array    $urlparams  An array of safe URL parameters and their variable types
     *
     * @return  BaseController  This object to support chaining
     */
    public function display($cachable = false, $urlparams = [])
    {
        Log::add('DisplayController::display()', Log::DEBUG, 'sendy');
        //$view = $this->input->get('view', 'subscribe');
        //this->input->set('view', $view);

        return parent::display($cachable = false, $urlparams = []);
    }
} 