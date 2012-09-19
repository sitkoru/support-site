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
			{$content.text}
			
		{preload module=start data=recs dir=$content.sid result=recs}
		{if $recs}
			<p></p>
			<hr />
			<h3>Подразделы</h3>
			<ol>
			{foreach from=$recs item=rec}
				<li><a href="{$rec.url}">{$rec.title}</a></li>
			{/foreach}
			</ol>
		{/if}
		  
			</div><!--/span-->
		</div><!--/row-->

{include file='footer.tpl'}