<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_sendy/subscribe-ajax.js', ['version' => 'auto', 'relative' => true]);

$params = $this->params;
?>

<?php if ($params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1><?php echo $this->escape($params->get('page_heading', '')); ?></h1>
    </div>
<?php endif; ?>

<div class="sendy-subscribe<?php echo $params->get('pageclass_sfx', ''); ?>">
    <div id="subscription-messages"></div>
    <form id="sendy-subscribe-form" class="form-validate">
        <div class="mb-4">
            <label for="fullname" class="form-label"><?php echo Text::_('COM_SENDY_NAME_LABEL'); ?></label>
            <input type="text"
                name="name"
                id="name"
                placeholder="Enter your name"
                class="form-control required"
                required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"><?php echo Text::_('COM_SENDY_EMAIL_LABEL'); ?></label>
            <input type="email" class="form-control required validate-email" name="email" id="email" required>
        </div>

        <button type="submit"
            class="spin flex-box Montserrat-Regular">
            <?php echo Text::_('COM_SENDY_SUBMIT'); ?>
        </button>

        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
</div> 