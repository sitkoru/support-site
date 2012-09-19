{addjs val="
	/cssing/bootstrap/js/bootstrap.js
	http://code.highcharts.com/highcharts.js

	/cssing/j/history.js
	/cssing/j/j.js
"}{addcss val="
	/cssing/bootstrap/css/bootstrap.css
	/cssing/c/s.css
"}{include file="`$paths.admin_templates`/head.tpl" head_add=$head_add }
<body data-spy="scroll" data-target=".subnav" data-offset="50" data-twttr-rendered="true">
    {if $user.admin}
    	{literal}
    	<script type="text/javascript">
    		$(document).ready(function() {
    			$('body').css('padding-top','100px');
    			$('.navbar-fixed-top').css('top', '32px');
    			$('#acms_bar').css('border-width','0');
    		});
    	</script>
    	<style type="text/css">
    		.subnav-fixed { top: 82px !important; }
    	</style>
    	{/literal}
    	<div style="position: fixed; top: 0; left: 0; height: 35px; z-index: 120; width: 100%; background-color: white;"></div>
    {/if}
	<!-- Like buttons scripts -->
	<div id="fb-root"></div>
	<!-- /Like buttons scripts -->
	
    	<!-- Главное меню -->
		<div class="navbar navbar-fixed-top mainmenu">
	      <div class="navbar-inner">
	        <div class="container">
	          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <div class="nav-collapse collapse">
	            <div class="row">
					<div class="span8">
						<ul class="nav">
							<li><a class="logo" href="/"></a></li>
							
							<li><a href="/groups.html">Сети</a></li>
							<li><a href="/users.html">Люди</a></li>
							<li><a href="/posts.html">Сюжеты</a></li>
							<li><a href="/gadgets.html">Гаджеты</a></li>
							<li><a href="/services.html">Сервисы</a></li>
							<li><a href="/apps.html">Приложения</a></li>
							<li><a href="/company.html">Компании</a></li>
<!--							
							{foreach from=$mainmenu item=rec key=key}
									{if $key > 4}{break}{/if}
									<li><a href="{$rec.url}">{$rec.title}</a></li>
							{/foreach}
									<li>
										<a href="/groups.html">Сети</a>
									</li>
						</ul>
							<div class="btn-group" style="float: left;">
					          <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Еще <span class="caret"></span></button>
					          <ul class="dropdown-menu">
					            {foreach from=$mainmenu item=rec key=key}
									{if $key > 4}
									 <li><a href="{$rec.url}">{$rec.title}</a></li>
									{/if}
								{/foreach}
									<li><a href="/apps.html">Приложения</a></li>
									<li><a href="/services.html">Сервисы</a></li>
									<li><a href="/goodies.html">Конкурсы</a></li>
									<li><a href="/price.html">Цены</a></li>
					          </ul>
							</div>
-->
					</div>
					<div class="span2">
						<div class="city">
							{preload module=city data=my_city result=city}
							Ваш регион:<br>
							<mark class="white current" title="Изменить" onclick="alert('диалог изменения региона здесь появляется..')">{$city.region}</mark>
						</div>
					</div>
					<div class="span2">
						<span class="search" onclick="alert('форма поиска по всем сайту выплывает..');">Поиск</span>
					</div>
				</div>
	          </div>
	        </div>
	      </div>
	    </div>
		<!-- /Главное меню -->
		
		<!-- Главная обертка -->
		<div class="container">