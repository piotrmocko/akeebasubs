<?php
/**
 *  @package FrameworkOnFramework
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 */

// Protect from unauthorized access
defined('_JEXEC') or die();

FOFTemplateUtils::addCSS('media://com_akeebasubs/css/frontend.css?'.AKEEBASUBS_VERSIONHASH);

$this->loadHelper('cparams');
$this->loadHelper('modules');
$this->loadHelper('format');

?>

<?php if(AkeebasubsHelperCparams::getParam('stepsbar',1)):?>
<?php $step = 'done'; require_once dirname(__FILE__).'/../../level/tmpl/steps.php'; ?>
<?php endif; ?>

<h1 class="componentheading">
	<?php echo $this->escape(JText::_('COM_AKEEBASUBS_MESSAGE_THANKYOU')) ?>
</h1>

<?php echo JHTML::_('content.prepare', $this->item->ordertext) ?>

<div class="akeebasubs-goback">
	<p><a href="<?php echo JURI::base()?>"><?php echo JText::_('COM_AKEEBASUBS_MESSAGE_BACK')?></a></p>
</div>