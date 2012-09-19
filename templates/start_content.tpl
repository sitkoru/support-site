{include file='head.tpl'}

<body>

{include file='top.tpl'}

    <div class="container-fluid">
		<div class="row-fluid">
		
			<div class="span3">
{include file='mainmenu.tpl'}
			</div><!--/span-->
			
			<div class="span9">
			
			<h1>{$content.title}</h1>
			{$content.text}
		  
			</div><!--/span-->
		</div><!--/row-->

		<hr>

		<footer>
			<p>&copy; Company 2012</p>
		</footer>

    </div><!--/.fluid-container-->

{include file='footer.tpl'}