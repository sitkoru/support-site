<ul class="breadcrumb">
{foreach from=$path item=rec}
	<li><a href="{$rec.url}">{$rec.title}</a> <span class="divider">/</span></li>
{/foreach}
	<li class="active">{$content.title}</li>
</ul>