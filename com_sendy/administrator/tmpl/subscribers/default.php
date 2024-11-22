<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

//HTMLHelper::_('behavior.multiselect');

$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');

?>
<form action="index.php?option=com_sendy" method="post" name="adminForm" id="adminForm">
    <?php //echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="w-1 text-center">
                        <?php echo HTMLHelper::_('grid.checkall'); ?>
                    </th>
                    <th scope="col">
                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_SENDY_NAME', 'name', $listDirn, $listOrder); ?>
                    </th>
                    <th scope="col">
                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_SENDY_EMAIL', 'email', $listDirn, $listOrder); ?>
                    </th>
                    <th scope="col">
                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_SENDY_STATUS', 'status', $listDirn, $listOrder); ?>
                    </th>
                    <th scope="col">
                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_SENDY_CREATED', 'created', $listDirn, $listOrder); ?>
                    </th>
                    <th scope="col">
                        <?php echo Text::_('COM_SENDY_SENDY_STATUS'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($this->items)) : ?>
                    <?php foreach ($this->items as $i => $item) : ?>
                        <tr>
                            <td class="text-center">
                                <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                            </td>
                            <td>
                                <?php echo $this->escape($item->name); ?>
                            </td>
                            <td>
                                <?php echo $this->escape($item->email); ?>
                            </td>
                            <td>
                                <?php echo $item->status ? Text::_('JYES') : Text::_('JNO'); ?>
                            </td>
                            <td>
                                <?php echo HTMLHelper::_('date', $item->created, Text::_('DATE_FORMAT_LC4')); ?>
                            </td>
                            <td>
                                <?php echo $this->escape($item->sendy_status); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo $this->pagination->getListFooter(); ?>

    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>
</form> 