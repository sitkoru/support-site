<ul class="breadcrumb">
{foreach from=$path item=rec key=key}{if $key+1<count($recs) }
	<li><a href="{$rec.url}">{$rec.title}</a> <span class="divider">/</span></li>
{/if}{/foreach}
	<li class="active">{$content.title}</li>
</ul>