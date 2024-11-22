<?php
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
?>
<div class="sendy-subscribe-module w-full h-auto p-4 px-4 rounded-15px bg-light-pink md:px-12 lg:px-8">
    <h2 class="text-center rounded-17px text-deep-maroon Montserrat-Medium text-24px lg:text-30px px-4 lg:px-12 mb-4 [text-wrap:balance]"><?php echo $module->title; ?></h2>
    <div id="subscription-messages"></div>
    <form id="sendy-subscribe-form" class="form-validate">
        <div class="mb-4">
            <label for="fullname" class="form-label"></label>
            <input type="text"
                name="name"
                id="fullname"
                placeholder="Enter your name"
                class="form-control w-full rounded-[6px] text-charcoal text-17px h-[44px] lg:h-[52px] lg:text-24px px-2 lg:px-4"
                required>
        </div>

        <div class="mb-6">
            <label for="email"></label>
            <input type="email"
                name="email"
                id="email"
                placeholder="Enter your email"
                class="form-control w-full rounded-[6px] text-charcoal text-17px h-[44px] lg:h-[52px] lg:text-24px px-2 lg:px-4"
                required>
        </div>

        <?php if ($params->get('disclaimer_text')) : ?>
            <div class="pre-button-text mb-4">
                <?php echo $params->get('disclaimer_text'); ?>
            </div>
        <?php endif; ?>

        <button type="submit"
            class="spin flex-box Montserrat-Regular">
            <?php echo Text::_('MOD_SENDY_SUBMIT'); ?>
        </button>

        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
</div>