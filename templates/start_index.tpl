{include file='head.tpl'}

<body>

{include file='top.tpl'}

    <div class="container-fluid">
		<div class="row-fluid">
		
			<div class="span3">
{include file='mainmenu.tpl'}
			</div><!--/span-->
			
			<div class="span9">
			
			<div class="hero-unit">
				<h1>{$content.title}</h1>
				{$content.text}
			</div>
		  
			<h4>Новые статьи</h4>
			<div class="row-fluid">
			{preload module=start data=recs result=recs}
			{foreach from=$recs item=rec}
				<div class="span4">
					<h2><a href="{$rec.url}">{$rec.title}</a></h2>
					<p>{$rec.preview|cut:150:'...'}</p>
					<p><a class="btn" href="{$rec.url}">Подробнее &raquo;</a></p>
				</div><!--/span-->
			{/foreach}
			</div><!--/row-->
			
          <div class="row-fluid">
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
		  
			</div><!--/span-->
		</div><!--/row-->

		<hr>

		<footer>
			<p>&copy; Company 2012</p>
		</footer>

    </div><!--/.fluid-container-->

{include file='footer.tpl'}