<?php
namespace BKWSU\Component\Sendy\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Log\Log;

class SubscribeController extends FormController
{
    public function submit()
    {
        Log::add('submit called', Log::DEBUG, 'com_sendy');
        $this->checkToken();
        
        $app = Factory::getApplication();
        $input = $app->input;
        
        // Validate email format
        $email = $input->getString('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $app->enqueueMessage(Text::_('COM_SENDY_INVALID_EMAIL'), 'error');
            $this->setRedirect(Route::_('index.php?option=com_sendy&view=subscribe'));
            return false;
        }
        
        // Validate name (not empty and no special characters)
        $name = $input->getString('name');
        if (empty($name) || !preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            $app->enqueueMessage(Text::_('COM_SENDY_INVALID_NAME'), 'error');
            $this->setRedirect(Route::_('index.php?option=com_sendy&view=subscribe'));
            return false;
        }
        
        $data = [
            'name' => $input->getString('name'),
            'email' => $input->getString('email')
        ];

        $model = $this->getModel('Subscribe');
        
        if ($model->subscribe($data)) {
            $app->enqueueMessage(Text::_('COM_SENDY_SUCCESS_MESSAGE'));
        } else {
            $app->enqueueMessage(Text::_('COM_SENDY_ERROR_MESSAGE'), 'error');
        }

        $this->setRedirect(Route::_('index.php?option=com_sendy&view=subscribe'));
    }

    public function ajaxSubmit()
    {
        Log::add('ajaxSubmit called', Log::DEBUG, 'com_sendy');
        $this->checkToken();
        
        $app = Factory::getApplication();
        $input = $app->input;
        $response = ['success' => false, 'message' => ''];

        // Validate email format
        $email = $input->getString('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = Text::_('COM_SENDY_INVALID_EMAIL');
            echo json_encode($response);
            $app->close();
        }
        
        // Validate name
        $name = $input->getString('name');
        if (empty($name) || !preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            $response['message'] = Text::_('COM_SENDY_INVALID_NAME');
            echo json_encode($response);
            $app->close();
        }
        
        $data = [
            'name' => $name,
            'email' => $email
        ];

        $model = $this->getModel('Subscribe');
        
        if ($model->subscribe($data)) {
            $response['success'] = true;
            $response['message'] = Text::_('COM_SENDY_SUBSCRIPTION_SUCCESS');
            $response['messages'] = $app->getMessageQueue();
        } else {
            $response['message'] = Text::_('COM_SENDY_SUBSCRIPTION_FAILED');
            $response['messages'] = $app->getMessageQueue();
        }

        echo json_encode($response);
        $app->close();
    }
} 