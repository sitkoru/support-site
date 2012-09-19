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
		  
			</div><!--/span-->
		</div><!--/row-->

{include file='footer.tpl'}