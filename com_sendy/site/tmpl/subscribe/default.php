<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');

$params = $this->params;
?>

<?php if ($params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1><?php echo $this->escape($params->get('page_heading', '')); ?></h1>
    </div>
<?php endif; ?>

<div class="sendy-subscribe<?php echo $params->get('pageclass_sfx', ''); ?>">
    <form action="<?php echo Route::_('index.php?option=com_sendy&task=subscribe.submit'); ?>"
          method="post" class="form-validate">
        
        <div class="mb-3">
            <label for="name" class="form-label"><?php echo Text::_('COM_SENDY_NAME_LABEL'); ?></label>
            <input type="text" class="form-control required" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"><?php echo Text::_('COM_SENDY_EMAIL_LABEL'); ?></label>
            <input type="email" class="form-control required validate-email" name="email" id="email" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <?php echo Text::_('COM_SENDY_SUBMIT'); ?>
        </button>

        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
</div> 