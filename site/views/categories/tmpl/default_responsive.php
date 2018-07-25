<?php
/**
 * @version 2.1.5
 * @package JEM
 * @copyright (C) 2013-2015 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$styleSheets = $document->_styleSheets;
$faFound = false;
foreach ($styleSheets as $key => $value) {
  if (strpos($key,'font-awesome.min.css') !== false) {
    $faFound = true;
    break;
  }
}
if (!$faFound) {
  $document->addStylesheet(JUri::base(true).'/media/com_jem/FontAwesome/font-awesome.min.css');
}

function jem_categories_string_contains($masterstring, $string) {
  if (strpos($masterstring, $string) !== false) {
    return true;
  } else {
    return false;
  }
}

?>
<div id="jem" class="jem_categories<?php echo $this->pageclass_sfx;?>">
	<div class="buttons">
		<?php
		$btn_params = array('id' => $this->id, 'task' => $this->task, 'print_link' => $this->print_link);
		echo JemOutput::createButtonBar($this->getName(), $this->permissions, $btn_params);
		?>
	</div>

	<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1 class="componentheading">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php endif; ?>

	<?php foreach ($this->rows as $row) : ?>
		<h2 class="jem cat<?php echo $row->id; ?>">
			<?php echo JHtml::_('link', JRoute::_($row->linktarget), $this->escape($row->catname)); ?>
		</h2>
    
    <?php if (($this->jemsettings->discatheader) && (!empty($row->image))) : ?>
      <div class="jem-catimg">
        <?php $cimage = JemImage::flyercreator($row->image, 'category'); ?>
        <?php	echo JemOutput::flyer($row, $cimage, 'category'); ?>
      </div>
    <?php endif; ?>
    
    <div class="description">
      <?php echo $row->description; ?>
      <?php if ($i = count($row->subcats)) : ?>
        <h3 class="subcategories">
          <?php echo JText::_('COM_JEM_SUBCATEGORIES'); ?>
        </h3>
        <div class="subcategorieslist">
          <?php foreach ($row->subcats as $sub) : ?>
            <strong>
              <a href="<?php echo JRoute::_(JemHelperRoute::getCategoryRoute($sub->slug, $this->task)); ?>">
                <?php echo $this->escape($sub->catname); ?></a>
            </strong> <?php echo '(' . ($sub->assignedevents != null ? $sub->assignedevents : 0) . (--$i ? '),' : ')'); ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    
    <div class="jem-clear">
    </div>
    
		<!--table-->
		<?php
			if ($this->params->get('detcat_nr', 0) > 0) {
				$this->catrow = $row;
        echo '<h3>'.JTEXT::_('COM_JEM_EVENTS').'</h3>';
				echo $this->loadTemplate('table');
			}
		?>
    <div class="jem-readmore">
      <a href="<?php echo JRoute::_($row->linktarget); ?>" title="<?php echo JText::_('COM_JEM_CALENDAR_SHOWALL'); ?>">
        <button class="buttonfilter btn">
          <?php echo JText::_('COM_JEM_CALENDAR_SHOWALL') ?>
          <?php if ($row->assignedevents > 1) :
              echo ' - '.$row->assignedevents.' '.JTEXT::_('COM_JEM_EVENTS');
            elseif ($row->assignedevents == 1) :
              echo ' - '.$row->assignedevents.' '.JTEXT::_('COM_JEM_EVENT');
            else : 
              echo '- 0 '.JTEXT::_('COM_JEM_EVENTS'); 
            endif;
          ?>
        </button>
      </a>
    </div>    
    
    <?php 
    if ($row !== end($this->rows)) :
        echo '<hr class="jem-hr">';
    endif;
    ?>
	<?php endforeach; ?>

	<!--pagination-->
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>

	<!--copyright-->
	<div class="copyright">
		<?php echo JemOutput::footer( ); ?>
	</div>
</div>
