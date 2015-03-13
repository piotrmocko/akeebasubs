<?php
/**
 *  @package AkeebaSubs
 *  @copyright Copyright (c)2010-2015 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 */

defined('_JEXEC') or die();

use \Akeeba\Subscriptions\Admin\Helper\ComponentParams;
use \Akeeba\Subscriptions\Admin\Helper\Image;
use \Akeeba\Subscriptions\Admin\Helper\Message;

/** @var \Akeeba\Subscriptions\Site\View\Levels\Html $this */

?>

<div id="akeebasubs" class="levels awesome">

<?php echo $this->getContainer()->template->loadPosition('akeebasubscriptionslistheader')?>

<?php $max = count($this->items); ?>

<div class="akeebasubs-awesome">
	<div class="columns columns-<?php echo $max?>">
		<?php $i = 0; foreach($this->items as $level): $i++?>
		<?php
			$priceInfo = $this->getLevelPriceInformation($level);
		?>
		<div class="akeebasubs-awesome-column akeebasubs-level-<?php echo $level->akeebasubs_level_id ?>">
			<div class="column-<?php echo $i == 1 ? 'first' : ($i == $max ? 'last' : 'middle')?>">
				<div class="akeebasubs-awesome-header">
					<div class="akeebasubs-awesome-level">
						<a href="<?php echo \JRoute::_('index.php?option=com_akeebasubs&view=Level&layout=default&format=html&slug='. $level->slug)?>" class="akeebasubs-awesome-level-link">
							<?php echo $this->escape($level->title)?>
						</a>
					</div>
					<div class="akeebasubs-awesome-price">
						<?php if($this->renderAsFree && ($priceInfo->levelPrice < 0.01)):?>
						<?php echo JText::_('COM_AKEEBASUBS_LEVEL_LBL_FREE') ?>
						<?php else: ?>
						<?php if(ComponentParams::getParam('currencypos','before') == 'before'): ?><span class="akeebasubs-awesome-price-currency"><?php echo ComponentParams::getParam('currencysymbol','€')?></span><?php endif; ?><span class="akeebasubs-awesome-price-integer"><?php echo $priceInfo->priceInteger ?><?php if((int)$priceInfo->priceFractional > 0): ?></span><span class="akeebasubs-awesome-price-separator">.</span><span class="akeebasubs-awesome-price-decimal"><?php echo $priceInfo->priceFractional ?></span><?php endif; ?><?php if(ComponentParams::getParam('currencypos','before') == 'after'): ?><span class="akeebasubs-awesome-price-currency"><?php echo ComponentParams::getParam('currencysymbol','€')?></span><?php endif; ?>
						<?php endif; ?>
					</div>
					<?php if ((float)$priceInfo->vatRule->taxrate > 0.01): ?>
					<div class="akeebasubs-awesome-taxnotice">
						<?php if ($priceInfo->levelPrice > 0.01): ?>
						<?php echo JText::sprintf('COM_AKEEBASUBS_LEVELS_INCLUDESVAT', (float)$priceInfo->vatRule->taxrate); ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ($this->includeDiscount): ?>
					<div class="akeebasubs-awesome-prediscount">
						<?php if(abs($priceInfo->discount) >= 0.01): ?>
						<span class="akeebasubs-awesome-prediscount-label">
						<?php echo JText::_('COM_AKEEBASUBS_LEVEL_FIELD_PREDISCOUNT'); ?>
						</span>
						<s>
						<?php if(ComponentParams::getParam('currencypos','before') == 'before'): ?><span class="akeebasubs-awesome-price-currency"><?php echo ComponentParams::getParam('currencysymbol','€')?></span><?php endif; ?><span class="akeebasubs-awesome-price-integer"><?php echo $priceInfo->discountInteger ?></span><?php if((int)$priceInfo->discountFractional > 0): ?><span class="akeebasubs-awesome-price-separator">.</span><span class="akeebasubs-awesome-price-decimal"><?php echo $priceInfo->discountFractional ?></span><?php endif; ?><?php if(ComponentParams::getParam('currencypos','before') == 'after'): ?><span class="akeebasubs-awesome-price-currency"><?php echo ComponentParams::getParam('currencysymbol','€')?></span><?php endif; ?>
						</s>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ($this->includeSignup == 2): ?>
					<div class="akeebasubs-awesome-signup">
						<?php if(abs($priceInfo->signupFee) >= 0.01): ?>
						<?php echo JText::_('COM_AKEEBASUBS_LEVEL_FIELD_SIGNUPFEE_LIST'); ?>
						<?php if(ComponentParams::getParam('currencypos','before') == 'before'): ?><span class="akeebasubs-awesome-price-currency"><?php echo ComponentParams::getParam('currencysymbol','€')?></span><?php endif; ?><span class="akeebasubs-awesome-price-integer"><?php echo $priceInfo->signupInteger ?></span><?php if((int)$priceInfo->signupFractional > 0): ?><span class="akeebasubs-awesome-price-separator">.</span><span class="akeebasubs-awesome-price-decimal"><?php echo $priceInfo->signupFractional ?></span><?php endif; ?><?php if(ComponentParams::getParam('currencypos','before') == 'after'): ?><span class="akeebasubs-awesome-price-currency"><?php echo ComponentParams::getParam('currencysymbol','€')?></span><?php endif; ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="akeebasubs-awesome-body">
					<div class="akeebasubs-awesome-image">
						<img src="<?php echo Image::getURL($level->image)?>" />
					</div>
					<div class="akeebasubs-awesome-description">
						<?php echo JHTML::_('content.prepare', Message::processLanguage($level->description) );?>
					</div>
				</div>
				<div class="akeebasubs-awesome-footer">
					<td class="akeebasubs-awesome-subscribe">
						<button
							class="btn btn-inverse btn-default"
							onclick="window.location='<?php echo \JRoute::_('index.php?option=com_akeebasubs&view=level&slug='.$level->slug.'&format=html&layout=default')?>'">
							<?php echo JText::_('COM_AKEEBASUBS_LEVELS_SUBSCRIBE')?>
						</button>
					</td>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
		<div class="level-clear"></div>
	</div>
</div>

<?php echo $this->getContainer()->template->loadPosition('akeebasubscriptionslistfooter')?>
</div>