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
			{preload module=start data=recs order='order by `date_modify` desc' result=recs}
			{foreach from=$recs item=rec}
				<div class="span4" style="height:150px;">
					<h4><a href="{$rec.url}">{$rec.title}</a></h4>
					<p>{$rec.text|strip_tags|cut:100:'...'}</p>
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

{include file='footer.tpl'}