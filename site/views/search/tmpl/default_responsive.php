<?php
/**
 * @version 2.1.7
 * @package JEM
 * @copyright (C) 2013-2016 joomlaeventmanager.net
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

function jem_search_string_contains($masterstring, $string) {
  if (strpos($masterstring, $string) !== false) {
    return true;
  } else {
    return false;
  }
}

?>

<div id="jem" class="jem_search<?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="componentheading">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<div class="clr"></div>

	<?php if ($this->params->get('showintrotext')) : ?>
	<div class="description no_space floattext">
		<?php echo $this->params->get('introtext'); ?>
	</div>
	<?php endif; ?>
  
  <h2>
    <?php echo JText::_('COM_JEM_SEARCH_SUBMIT');?>
  </h2>
	<!--table-->
	<form action="<?php echo htmlspecialchars($this->action); ?>" method="post" name="adminForm" id="adminForm">
		<?php
		/*if ($this->params->get('template_suffix')) {
			echo $this->loadTemplate('table_'. $this->params->get('template_suffix'));
		} else {*/
			echo $this->loadTemplate('table_responsive');
		//}
		?>

		<p>
			<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
			<input type="hidden" name="task" value="<?php echo $this->task; ?>" />
			<input type="hidden" name="view" value="search" />
		</p>
	</form>

	<!--footer-->
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>

	<div class="copyright">
		<?php echo JemOutput::footer( ); ?>
	</div>
</div>
