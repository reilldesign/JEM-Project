<?php
/**
 * @version 2.3.0
 * @package JEM
 * @copyright (C) 2013-2021 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');							 
?>
	<?php /*?>	
<style>
div#jem_filter select {
    width: auto;
    margin-right:10px;
    border: 1px solid #808080;
	background-color: #C6CCBE;
	cursor: pointer;
}
</style>
	<?php */?>	

<form action="<?php echo htmlspecialchars($this->action); ?>" method="post" id="adminForm" name="adminForm">

<?php
function jem_common_show_filter(&$obj) {
  if ($obj->settings->get('global_show_filter',1) && !JemHelper::jemStringContains($obj->params->get('pageclass_sfx'), 'jem-hidefilter')) {
    return true;
  }
  if (JemHelper::jemStringContains($obj->params->get('pageclass_sfx'), 'jem-showfilter')) {
    return true;
  }
  return false;
}
?>
<?php if (jem_common_show_filter($this) && !JemHelper::jemStringContains($this->params->get('pageclass_sfx'), 'jem-filterbelow')): ?>
  <div id="jem_filter" class="floattext jem-form jem-row jem-justify-start">
    <div>
      <?php echo '<label for="filter">'.JText::_('COM_JEM_FILTER').'</label>'; ?>
    </div>
    <div class="jem-row jem-justify-start jem-nowrap">
      <?php echo $this->lists['filter']; ?>
      <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->lists['search'];?>" class="inputbox" onchange="document.adminForm.submit();" />
    </div>
    <div class="jem-row jem-justify-start jem-nowrap">
      <button class="buttonfilter btn btn-primary" type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
      <button class="buttonfilter btn btn-secondary" type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button> 
    </div>
	  	<?php if ($this->settings->get('global_display',1)) : ?>
	<div class="jem_fright">
		   
		<label for="limit"><?php echo JText::_('COM_JEM_DISPLAY_NUM'); ?></label>
		<?php echo $this->pagination->getLimitBox(); ?>
		
	</div>
	<?php endif; ?>
  </div>

<?php endif; ?>




















	<div class="table-responsive">
	<table class="eventtable" style="width:<?php echo $this->jemsettings->tablewidth; ?>;" summary="Venues">
		<colgroup>
			<col width="20%" class="jem_col_city" />
	<?php if ($this->params->get('showstate')) : ?>			
			<col width="20%" class="jem_col_state" />
	<?php endif; ?>	
			<col width="<?php echo $this->jemsettings->locationwidth; ?>" class="jem_col_venue" />

		</colgroup>
		<thead>
			<tr>
				<th id="jem_city" class="sectiontableheader" align="left"><?php echo JHtml::_('grid.sort', 'COM_JEM_TABLE_CITY', 'a.city', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	<?php if ($this->params->get('showstate')) : ?>
				<th id="jem_state" class="sectiontableheader" align="left"><?php echo JHtml::_('grid.sort', 'COM_JEM_TABLE_STATE', 'a.state', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	<?php endif; ?>	
			
			

				<th id="jem_location" class="sectiontableheader" align="left"><?php echo JHtml::_('grid.sort', 'COM_JEM_TABLE_LOCATION', 'a.venue', $this->lists['order_Dir'], $this->lists['order']); ?></th>



			</tr>
		</thead>

		<tbody>
			<?php if (empty($this->rows)) : ?>
				<tr class="no_events"><td colspan="20"><?php echo JText::_('COM_JEM_NO_VENUES'); ?></td></tr>
			<?php else : ?>
				<?php $odd = 0; ?>
				<?php foreach ($this->rows as $row) : ?>
					<?php $odd = 1 - $odd; ?>
					<td headers="jem_city" align="left" valign="top"><?php echo $row->city ? $this->escape($row->city) : '-'; ?></td>
				<?php if ($this->params->get('showstate')) : ?>
					<td headers="jem_state" align="left" valign="top">
						<?php echo !empty($row->state) ? $this->escape($row->state) : '-'; ?>
					</td>	
				<?php endif; ?>		
				
					<td headers="jem_location" align="left" valign="top">
						<?php
						if ($this->jemsettings->showlinkvenue == 1) :
							echo $row->id != 0 ? "<a href='".JRoute::_(JemHelperRoute::getVenueRoute($row->venueslug))."'>".$this->escape($row->venue)."</a>" : '-';
						else :
							echo $row->id ? $this->escape($row->venue) : '-';
						endif;
						?>
					</td>





				</tr>

				<?php// $i = 1 - $i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
	</div>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="com_jem" />
	<?php echo JHtml::_('form.token'); ?>
</form>

<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>