<?php
namespace BKWSU\Component\Sendy\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;

class SubscribeModel extends BaseDatabaseModel
{
    public function subscribe($data)
    {
        Log::add('SubscribeModel::subscribe()', Log::DEBUG, 'sendy');
        $app = Factory::getApplication();
        $params = $app->getParams();

        // Get Sendy configuration
        $sendyUrl = $params->get('sendy_url');
        $apiKey = $params->get('sendy_api_key');
        $listId = $params->get('sendy_list_id');

        // Validate Sendy configuration
        if (empty($sendyUrl) || empty($apiKey) || empty($listId)) {
            Log::add('Missing Sendy configuration', Log::ERROR, 'com_sendy');
            Factory::getApplication()->enqueueMessage(
                Text::_('COM_SENDY_MISSING_CONFIG'),
                'error'
            );
            throw new \RuntimeException(Text::_('COM_SENDY_MISSING_CONFIG'));
        }

        // Prepare data for Sendy
        $postData = [
            'api_key' => $apiKey,
            'list' => $listId,
            'email' => $data['email'],
            'name' => $data['name'],
            'boolean' => 'true'
        ];

        // Send to Sendy
        $ch = curl_init($sendyUrl . '/subscribe');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        Log::add('Sendy URL: ' . $sendyUrl . '/subscribe', Log::DEBUG, 'com_sendy');

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            Log::add('Curl error: ' . $error, Log::ERROR, 'com_sendy');
            Factory::getApplication()->enqueueMessage(
                Text::sprintf('COM_SENDY_CURL_ERROR', $error),
                'error'
            );
            return false;
        }
        Log::add('Sendy response: ' . $result, Log::DEBUG, 'com_sendy');
        // Parse Sendy response
        if ($result != 'true' && $result != '1') {
            $errorMessage = Text::_('COM_SENDY_SENDY_ERROR');
            Log::add('Translation attempt: ' . $errorMessage, Log::DEBUG, 'com_sendy');
            Factory::getApplication()->enqueueMessage(
                Text::sprintf('COM_SENDY_SENDY_ERROR', $result),
                'error'
            );
            return false;
        }

        // Save to database
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $columns = ['email', 'name', 'created', 'status', 'sendy_status'];
        $values = [
            $db->quote($data['email']),
            $db->quote($data['name']),
            $db->quote(Factory::getDate()->toSql()),
            1,
            $db->quote($result)
        ];

        $query->insert($db->quoteName('#__sendy_subscribers'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        $db->setQuery($query);
        
        try {
            $db->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
} 