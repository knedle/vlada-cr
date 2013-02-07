<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.30015100 1360201702";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:56:"D:\wamp\www\vlada-cr\_\app\templates\Vlada\default.latte";i:2;i:1360201701;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"b7f6732 released on 2013-01-01";}}}?><?php

// source file: D:\wamp\www\vlada-cr\_\app\templates\Vlada\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'q8omd08wnm')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba57c5cf99a_content')) { function _lba57c5cf99a_content($_l, $_args) { extract($_args)
?><h3>Vznik české republiky: 1.1.1993</h3>

<p>Zdroje</p>
<ul>
	<li><a href="http://cs.wikipedia.org/wiki/Seznam_vl%C3%A1d_%C4%8Ceska">http://cs.wikipedia.org/wiki/Seznam_vl%C3%A1d_%C4%8Ceska</a>
		<li><a href="http://www.vlada.cz/cz/clenove-vlady/historie-minulych-vlad/prehled-vlad-cr/1993-2007-cr/vaclav-klaus-1/prehled-ministru-24631/">http://www.vlada.cz/cz/clenove-vlady/historie-minulych-vlad/prehled-vlad-cr/1993-2007-cr/vaclav-klaus-1/prehled-ministru-24631/</a>
			<li><a href="./_editor/editor.php">administrace</a>
			</ul>


<?php $vypsanyRok = 0 ?>
			<div class='timeline'>
<?php $iterations = 0; foreach ($osa as $udaj): ?>

<?php $id = $udaj->iid ;ob_start() ?>
				<?php echo Nette\Templating\Helpers::escapeHtml($template->date($udaj->datum, "%Y"), ENT_NOQUOTES) ?>

<?php $rok = ob_get_clean() ;ob_start() ?>
				<?php echo Nette\Templating\Helpers::escapeHtml($template->date($udaj->datum, "%d.%m."), ENT_NOQUOTES) ?>

<?php $mesicDen = ob_get_clean() ?>

				<div class="well">
					<div class="row">

						<div class="span2">
<?php if ($rok <> $vypsanyRok): ?>
							<b><?php echo Nette\Templating\Helpers::escapeHtml($rok, ENT_NOQUOTES) ?></b>
<?php $vypsanyRok = $rok ?>
							<?php endif ?>&nbsp;
						</div>

						<div class="span2">
							<b><?php echo Nette\Templating\Helpers::escapeHtml($mesicDen, ENT_NOQUOTES) ?></b>
						</div>

						<div class="span7">
<?php if ($udaj->osoba_id): ?>							<h4><?php echo Nette\Templating\Helpers::escapeHtml($udaj->cele_jmeno, ENT_NOQUOTES) ?>
 <?php if ($udaj->strana_id): ?><span>(<?php echo Nette\Templating\Helpers::escapeHtml($udaj->strana_nazev, ENT_NOQUOTES) ?>
)</span><?php endif ?>
</h4>
<?php endif ?>
							<p><?php echo Nette\Templating\Helpers::escapeHtml($udaj->typ, ENT_NOQUOTES) ?></p>
<?php if ($udaj->kabinet_id): ?>							<p><?php echo Nette\Templating\Helpers::escapeHtml($udaj->kabinet_nazev, ENT_NOQUOTES) ?>
 <?php if ($udaj->ministerstvo): ?><span>(<?php echo Nette\Templating\Helpers::escapeHtml($udaj->ministerstvo, ENT_NOQUOTES) ?>
)</span><?php endif ?>
</p>
<?php endif ?>
						</div>
<?php if (!empty($data2[$udaj->start_konec][$udaj->iid])): $iterations = 0; foreach ($data2[$udaj->start_konec][$udaj->iid] as $ministr): if ($ministr['osoba_id']): ?>						<p>
							<span class="span2 offset4"><?php echo Nette\Templating\Helpers::escapeHtml($ministr['cele_jmeno'], ENT_NOQUOTES) ?>
 <?php if ($ministr['strana_id']): ?><span>(<?php echo Nette\Templating\Helpers::escapeHtml($ministr['strana_nazev'], ENT_NOQUOTES) ?>
)</span><?php endif ?>
</span>
							<span class="span1">jako </span>
<?php if ($ministr['kabinet_id']): ?>							<span class="span3"><?php echo Nette\Templating\Helpers::escapeHtml($ministr['kabinet_nazev'], ENT_NOQUOTES) ?>
 <?php if ($ministr['ministerstvo']): ?><span>(<?php echo Nette\Templating\Helpers::escapeHtml($ministr['ministerstvo'], ENT_NOQUOTES) ?>
)</span><?php endif ?>
</span>
<?php endif ?>
						</p>
<?php endif ;$iterations++; endforeach ?>


<?php endif ?>




					</div>
				</div>
<?php $iterations++; endforeach ?>
			</div>

<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb8ee2b39b54_head')) { function _lb8ee2b39b54_head($_l, $_args) { extract($_args)
?>			<style>

			</style>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 