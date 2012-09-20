{include file='head.tpl'}

<body>

{include file='top.tpl'}

		<div class="row-fluid">
		
			<div class="span3">
{include file='mainmenu.tpl'}
			</div><!--/span-->
			
			<div class="span9">

{include file='path.tpl'}			
				
				<h1>{$content.title}</h1>
				<p>
					Вы искали: <strong>{$content.result.ask|escape:'htmlall'}</strong><br />
					Нашлось: {$content.result.count} {numeric value=$content.result.count form1='вариант' form2='варианта' form5='вариантов'}
				</p>
			
			{if $content.result.count > 0}
				<ol>
				{foreach from=$content.result.recs item=rec}
					<li><a href="{$rec.url}">{$rec.title}</a></li>
				{/foreach}
				</ol>
			{/if}
				
			{if count( $content.result.pages.items ) > 1}
				<div class="pagination">
					<ul>
					{foreach from=$content.result.pages.items item=page key=key}
						<li{if $key == $content.result.current} class="active"{/if}><a href="{$page.url}">{$key+1}</a></li>
					{/foreach}
					</ul>
				</div>
			{/if}
			
			
			</div><!--/span-->
		</div><!--/row-->

{include file='footer.tpl'}