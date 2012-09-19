{include file='head.tpl'}

<body>

{include file='top.tpl'}

		<div class="row-fluid">
		
			<div class="span3">
{include file='mainmenu.tpl'}
			</div><!--/span-->
			
			<div class="span9">
			
			<h1>{$content.title}</h1>
			{$content.text}
			<hr />
		  
			<h4>Новые статьи</h4>
			<div class="row-fluid">
			{preload module=start data=recs text=notempty limit='limit 30' order='order by `date_modify` desc' result=recs}
			{foreach from=$recs item=rec key=key}
				<div class="span4">
					<h4><a href="{$rec.url}">{$rec.title}</a></h4>
					<p>{$rec.text|strip_tags|cut:100:'...'}</p>
					<p><a class="btn" href="{$rec.url}">Подробнее &raquo;</a></p>
				</div><!--/span-->
			{if ($key+1) is div by 3 }
				</div>
				<div class="row-fluid">
			{/if}
			{/foreach}
			</div><!--/row-->
		  
			</div><!--/span-->
		</div><!--/row-->

{include file='footer.tpl'}