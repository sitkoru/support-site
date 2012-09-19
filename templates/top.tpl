	<hr>

	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">{$settings.domain_title}</a>
          <div class="nav-collapse collapse">
			<p class="navbar-text pull-right">
			{if $user.id}
				Авторизован под аккаунтом: <a href="#" class="navbar-link">{$user.title}</a>
			{else}
				Вход не выполнен
			{/if}
			</p>
            <ul class="nav">
              <li><a href="/">Главная</a></li>
              <li><a href="http://sitko.ru">Официальный сайт</a></li>
              <li><a href="http://blog.sitko.ru">Блог</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container" style="margin-top: 50px;">
