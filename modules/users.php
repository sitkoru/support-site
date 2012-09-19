<?php

class users_module extends default_module{

    public $title = 'Люди';

    public $interests = array(
        'Мобильники',
        'Фотоаппараты',
        'Читалки',
        'Планшеты',
        'Каталог',
        'Образование',
        'Развлечения',
        'Музыка',
        'Медицина',
        'Навигация',
        'Новости',
        'Спорт',
        'Погода'
    );

    public $activities = array(
        'Автор',
        'Фотограф',
        'Сочувствующий',
        'Читатель',
        'Маньяк-любитель'
    );

    //Таблица, где хранятся пользователи
    public $table = 'users';

    public $bad_passwords = array(
        '111111', '222222', '333333', '444444', '555555', '666666', '777777', '888888', '999999', '000000',
        '123456', '654321', 'qwerty', 'QWERTY', 'Qwerty', 'йцукен', 'ЙЦУКЕН', 'Йцукен',
        '1234567', '12345678', '123456789', '1234567890',
        'ПАРОЛЬ', 'пароль', 'gfhjkm', 'GFHJKM', 'зфыыцщкв', 'ЗФЫЫЦЩКВ', 'password', 'PASSWORD',
    );

    //Действия пользователя на сайте, подлежащие подсчёту, влияют на рейтинг.
    public $acts = array(
    );

    //Шаблоны в модуле по умолчанию
    public $prepares = array(

		'menu_user'			=> array( 'function' => 'getUserMenu', 'title' => 'Меню пользователя' ),
		'menu_select'		=> array( 'function' => 'getSelectMenu', 'title' => 'Меню отбора контента' ),
		'menu_content'		=> array( 'function' => 'getContentMenu', 'title' => 'Меню контента' ),
		'menu_actions'		=> array( 'function' => 'getActionsMenu', 'title' => 'Меню действий' ),
		'getComponentParams'		=> array( 'function' => 'getComponentParams', 'title' => 'Параметры текущего компонента' ),


		//Списки данных, принаджежащих пользователю
		'my_rating' => 				array('function' => 'compRating', 		'title' => 'Рейтинги', 			'menu'=>'user'),
		'my_posts' => 				array('function' => 'compPosts', 		'title' => 'Мои публикации', 	'menu'=>'user', 'divider'=>true),
		'my_comments' => 			array('function' => 'compPosts', 		'title' => 'Мои комментарии', 	'menu'=>'user'),
		'my_acts' => 				array('function' => 'compPosts', 		'title' => 'Мои действия', 		'menu'=>'user'),
		'my_apps' => 				array('function' => 'compPosts', 		'title' => 'Мои приложения', 	'menu'=>'user'),
		'my_friends' => 			array('function' => 'compFriends', 		'title' => 'Мои друзья', 		'menu'=>'user'),
		'my_have' => 				array('function' => 'compHave', 		'title' => 'Я использую', 		'menu'=>'user', 'divider'=>true),
		'my_recommend' => 			array('function' => 'compRecommend', 	'title' => 'Я рекомендую', 		'menu'=>'user'),
		'my_join' => 				array('function' => 'compJoin', 		'title' => 'Я читаю', 			'menu'=>'user'),
		'my_like' => 				array('function' => 'compLike', 		'title' => 'Мне нравится', 		'menu'=>'user'),
		'my_favorite' => 			array('function' => 'compFavorite', 	'title' => 'Моё избранное', 	'menu'=>'user'),
 
		'my_tags' 					=> array('function' => 'getPopularTags', 	'title' => 'Мои популярные теги'),

	);

    //Установка структур модуля
    public function setStructure(){
        $this->structure = array(
            'rec' => array(
                'title' => 'Пользователь',
                'fields' => array(
                    'date_logged' => 	array('type' => 'datetime', 'group' => 'system', 'title' => 'Дата последнего входа в систему'),

                    'title' => 			array('type' => 'text', 'group' => 'main', 'title' => 'Имя на сайте'),
                    'login' => 			array('type' => 'text', 'group' => 'main', 'title' => 'Логин'),
                    'password' => 		array('type' => 'password', 'group' => 'main', 'title' => 'Пароль', 'encrypt' => 'md5'),

                    'email' => 			array('type' => 'text', 'group' => 'main', 'title' => 'Адрес электронной почты'),
                    'sex' => 			array('type' => 'menu', 'group' => 'main', 'title' => 'Пол', 'variants' => array('мужской', 'женский', 'другой')),

                    'text' => 			array('type' => 'text', 'group' => 'main', 'title' => 'Очень кратко о себе'),
					'phone' => 			array('type' => 'text', 'group' => 'additional', 'title' => 'Мобильный'),
					'phone2' => 		array('type' => 'text', 'group' => 'additional', 'title' => 'Ещё мобильный'),
					'icq' => 			array('type' => 'text', 'group' => 'additional', 'title' => 'ICQ'),
					'jabber' => 		array('type' => 'text', 'group' => 'additional', 'title' => 'Jabber'),
					'skype' => 			array('type' => 'text', 'group' => 'additional', 'title' => 'Skype'),
					'msn' => 			array('type' => 'text', 'group' => 'additional', 'title' => 'MSN'),
					'twitter' => 		array('type' => 'text', 'group' => 'additional', 'title' => 'Twitter'),
					'web' => 			array('type' => 'text', 'group' => 'additional', 'title' => 'Сайт'),
					'blog' => 			array('type' => 'text', 'group' => 'additional', 'title' => 'Блог'),
					'company' => 		array('type' => 'text', 'group' => 'additional', 'title' => 'Компания'),
					'position' => 		array('type' => 'text', 'group' => 'additional', 'title' => 'Должность'),
                   
					'last_ip'=>			array('type'=>'text', 'group'=>'География', 'title'=>'Последний IP-адрес'),
					'city'=>			array('type'=>'link', 'group'=>'География', 'title'=>'Город', 'module'=>'city', 'structure_sid'=>'rec'),
					'region'=>			array('type'=>'menu', 'group'=>'География', 'title'=>'Регион', 'variants'=>model::$modules['city']->region),
					'macroregion'=>		array('type'=>'menu', 'group'=>'География', 'title'=>'Макрорегион', 'variants'=>model::$modules['city']->macroregion),

                    'show_phone' => 	array('type' => 'check', 'group' => 'additional', 'title' => 'Показывать номера телефонов', 'default' => true),
                    'show_icq' => 		array('type' => 'check', 'group' => 'additional', 'title' => 'Показывать ICQ, Jabber, Skype, MSN', 'default' => true),
                    'show_twitter' => 	array('type' => 'check', 'group' => 'additional', 'title' => 'Показывать Twitter', 'default' => true),
                    'show_company' => 	array('type' => 'check', 'group' => 'additional', 'title' => 'Показывать Компанию и должность', 'default' => true),

                    'moder' 						=> array('type' => 'check', 'group' => 'main', 'title' => 'Пользователь является модератором сайта', 'default' => false),
                    'admin' 						=> array('type' => 'check', 'group' => 'main', 'title' => 'Пользователь является администратором сайта', 'default' => false),
                    'active' 						=> array('type' => 'check', 'group' => 'main', 'title' => 'Аккаунт активен', 'default' => false),

                    'subscribe' 					=> array('type' => 'check', 'group' => 'main', 'title' => 'Подписка на рассылку новостей', 'default' => true),
                    'subscribe_my' 					=> array('type' => 'check', 'group' => 'main', 'title' => 'Уведомления о комментариях к моим записям', 'default' => true),
                    'subscribe_comments' 			=> array('type' => 'check', 'group' => 'main', 'title' => 'Уведомления об ответах на мои комментарии', 'default' => true),
                    'subscribe_friends' 			=> array('type' => 'check', 'group' => 'main', 'title' => 'Уведомления о публикациях друзей', 'default' => true),
                    'subscribe_corp_comments' 		=> array('type' => 'check', 'group' => 'main', 'title' => 'Уведомления о комментариях ко всему, что касается компании', 'default' => true),

                    'session_id' 					=> array('type' => 'hidden', 'group' => 'main', 'title' => 'session_id', 'default' => md5(date("Y-m-d H:i:s"))),
                    'online' 						=> array('type' => 'check', 'group' => 'main', 'title' => 'Пользователь сейчас на сате', 'default' => false),
                    'rating_position' 				=> array('type' => 'int', 'group' => 'main', 'title' => 'Позиция в рейтинге по всему сайту'),
                    'rating_position_city' 			=> array('type' => 'int', 'group' => 'main', 'title' => 'Позиция в рейтинге по городу'),
					'authority' 					=> array('type'=>'_rating', 'type_path'=>'../classes/field_usertype_rating.php', 'group'=>'system','title'=>'Авторитет пользователя', 'default'=>1),

                    'corporate' 					=> array('type' => 'link', 'group' => 'main', 'title' => 'Корпоративный пользователь', 'default' => false, 'module' => 'company', 'structure_sid' => 'rec'),
                ),
                'type' => 'simple',
                'dep_path' => false,
                'dep_param' => false,
//    			'hide_in_tree'=>true,		//Не выводить в древовидных структурах
            ),
        );

        $this->settings = array(
            'oauth_openid' => array( 
                'group' => 'OAuth', 
                'title' => 'Разрешённые Openid/OAuth провайдеры', 
                'type' => 'menum', 
                'variants' => array(
                    'yandex.ru' => 'Яндекс',
                    'google.com' => 'Google',
                    'facebook.com' => 'Facebook',
                    'vk.com' => 'Вконтакте',
                    'twitter.com' => 'Twitter',
                ), 
            ),
            'oauth_facebook_id' => array( 
                'group' => 'OAuth', 
                'title' => 'Facebook App ID', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'oauth_facebook_s_key' => array( 
                'group' => 'OAuth', 
                'title' => 'Facebook App Secret', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'oauth_twitter_id' => array( 
                'group' => 'OAuth', 
                'title' => 'Twitter Consumer key', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'oauth_twitter_s_key' => array( 
                'group' => 'OAuth', 
                'title' => 'Twitter Consumer secret', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'oauth_vk_id' => array( 
                'group' => 'OAuth', 
                'title' => 'VK ID приложения', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'oauth_vk_s_key' => array( 
                'group' => 'OAuth', 
                'title' => 'VK Защищенный ключ', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'oauth_redirect_url' => array( 
                'group' => 'OAuth', 
                'title' => 'Redirect Url', 
                'type' => 'text', 
                'default_value' => '', 
            ),
            'text_login_title' => array( 
                'group' => 'Тексты', 
                'title' => 'Название кнопки "Вход/Регистрация"', 
                'type' => 'text', 
                'default_value' => 'Вход / Регистрация', 
            ),
        );
		
		include_once( model::$config['path']['www'] . '/../classes/users_stuff.php' );		
		
		//Поля с мультимедиа
		posts_module::addMediaFields();
        
		//Добавляем всевозможные лайки
        require_once(model::$config['path']['www'].'/../classes/likes.php');
        likes::add('friends');
    
    }

	//Компоненты модуля, отвечают за вывод данных
    public function setComponents(){
		
		// Добавляем компоненты, только находясь в модуле
		if( model::$ask->module == $this->info['sid'] ){
			menu_maker::getUserMenu( $params );
			menu_maker::getSelectMenu( $params );
			menu_maker::getContentMenu( $params );
			menu_maker::getActionsMenu( $params );
		}
		
	}

    //Установка интерфейсов модуля
    public function setInterfaces(){
        $this->interfaces['login'] = array(
			'title' => 'Авторизация на сайте', //Название интерфейса
			'structure_sid' => 'rec', //Используемая структура текущего модуля
			'fields' => array(
				'login' => array(),
				'password' => array(),
                'remember' => array(),
			), //Поля, доступные в интерфейсе
			'ajax' => true,
			'protection' => false, //Защита формы
			'auth' => false, //Требуется ли авторизация для работы с интерфейсом
			'values' => false, //Использовать ли уже имеющуюся запись
            'control' => 'authUser',
            'template' => 'auth.tpl',
		);
        $this->interfaces['registration'] = array(
                'title' => 'Регистрация на сайте',
                'structure_sid' => 'rec',
                'fields' => array(
					'title' => array(),
                    'password' => array(),
                    'password_copy' => array('title'=>'Повторите пароль ещё раз', 'type'=>'password'),
                    'email' => array(),
//                    'avatar' => array('sid' => 'avatar', 'type' => 'image', 'title' => 'Выберите аватарку', 'template' => '../mobi/fieldset_avatar.tpl'),
                ),
                'ajax' => true,
                'protection' => false,
                'auth' => false,
                'use_record' => false,
                'control' => 'registerUser',
				'button_title' => 'Зарегистрироваться',
				'template' => 'registration.tpl',
        );
        $this->interfaces['recover'] = array(
			'title' => 'Восстановление пароля',
			'structure_sid' => 'rec',
			'fields' => array(
				'email' => array(),
			),
			'ajax' => true,
			'protection' => false,
			'auth' => false,
			'use_record' => false,
			'control' => 'recoverPassword',
        );
        $this->interfaces['profile'] = array(
			'title' => 'Профиль',
			'structure_sid' => 'rec',
			'fields' => array(
				'title' => array(),
				'text' 				=> array(),
				'phone' 			=> array(),
				'phone2' => array(),
				'email' => array(),
				'city' => array(),
				'company' => array(),
				'position' => array(),
				'address' => array(),
				'fax' => array(),
				'show_phone' => array(),
				'show_company' => array(),
			),
			'ajax' => true,
			'protection' => false,
			'auth' => true,
			'use_record' => true,
			'control' => 'updateProfile',
			'menu' => array(
				'group' => 'Настройки',
				'url' => user::$info['url_clear'].'.profile.html',
				'divider' => false,
			),
        );
        $this->interfaces['media'] = array(
			'title' => 'Фотографии',
			'structure_sid' => 'rec',
			'fields' => array(
				'img' => array(),
				'promo' => array(),
				'gallery' => array('template'=>'../interfaces/field_gallery.tpl'),
			),
			'ajax' => false,
			'protection' => false,
			'auth' => true,
			'use_record' => true,
			'control' => 'updateProfile',
        );
        $this->interfaces['subscribes'] = array(
			'title' => 'Управление подписками',
			'structure_sid' => 'rec',
			'fields' => array(
				'subscribe' => array(),
				'subscribe_my' => array(),
				'subscribe_comments' => array(),
				'subscribe_friends' => array(),
				'subscribe_corp_comments' => array(),
			),
			'ajax' => true,
			'protection' => false,
			'auth' => true,
			'use_record' => true,
			'control' => 'updateProfile',
			'menu' => array(
				'group' => 'Настройки',
				'url' => user::$info['url_clear'].'.subscribes.html',
				'divider' => false,
			),
        );
        $this->interfaces['password'] = array(
			'title' => 'Смена пароля',
			'structure_sid' => 'rec',
			'fields' => array(
				'old' => array('sid' => 'old', 'type' => 'password', 'group' => 'main', 'title' => 'Старый пароль'),
				'password' => array('sid' => 'password', 'type' => 'password', 'group' => 'main', 'title' => 'Новый пароль'),
				'password_copy' => array('title'=>'Повторите пароль ещё раз', 'type'=>'password'),
			),
			'ajax' => true,
			'protection' => false,
			'auth' => true,
			'use_record' => false,
			'control' => 'changePassword',
        );
        $this->interfaces['delete'] = array(
			'title' => 'Удалить мой профиль',
			'structure_sid' => 'rec',
			'fields' => array(
				'password' => array('title' => 'Укажите ваш пароль'),
				'delete_info' => array('sid' => 'delete_info', 'type' => 'check', 'group' => 'main', 'title' => 'Удалить все мои публикации', 'default'=>false),
				'delete_user' => array('sid' => 'delete_user', 'type' => 'check', 'group' => 'main', 'title' => 'Удалить мой профиль', 'default'=>false),
			),
			'ajax' => true,
			'protection' => false,
			'auth' => true,
			'use_record' => false,
			'control' => 'deleteMe',
			'divider' => true,
			'menu' => array(
				'group' => 'Настройки',
				'url' => user::$info['url_clear'].'.password.html',
				'divider' => false,
			),
        );
        $this->interfaces['invite'] = array(
			'title' => 'Пригласить друга',
			'structure_sid' => 'rec',
			'fields' => array(
				'title' => array('title'=>'Имя вашего друга'),
				'email' => array(),
			),
			'ajax' => true,
			'protection' => false,
			'auth' => true,
			'use_record' => false,
			'control' => 'inviteUser',
        );
    }


 	// Меню раздела
	public function getUserMenu( $params ){ return menu_maker::getUserMenu( $params, 'get' ); }
	public function getSelectMenu( $params ){ return menu_maker::getSelectMenu( $params, 'get' ); }
	public function getContentMenu( $params ){ return menu_maker::getContentMenu( $params, 'get' ); }
	public function getActionsMenu( $params ){ return menu_maker::getActionsMenu( $params, 'get' ); }
	public function getComponentParams( $params ){ if( IsSet( $this->prepares[ $params['sid'] ] ) )return $this->prepares[ $params['sid'] ]; return false; }





	//Компоненты
	public function compRating($params){			return users_stuff::compRating($params); }
	
	//Списки данных, принаджежащих пользователю''
    public function compMenuDefault($params){
		return comp_lib::getMenu( $this->prepares, $this->interfaces );
	}
	public function compMenu($params){				return users_stuff::compMenu($params); }
	public function compMenuProfile($params){		return users_stuff::compMenuProfile($params); }
	public function compPosts($params){				return users_stuff::compPosts($params); }
	public function compFriends($params){			return users_stuff::compFriends($params); }
	public function compHave($params){				return users_stuff::compHave($params); }
	public function compRecommend($params){			return users_stuff::compRecommend($params); }
	public function compJoin($params){				return users_stuff::compJoin($params); }
	public function compLike($params){				return users_stuff::compLike($params); }
	public function compFavorite($params){			return users_stuff::compFavorite($params); }
	
	public function compUsers($params){				return users_stuff::compUsers($params); }

    //Авторизация пользователя
    public function authUser($values, $conditions = false){

        //Авторизуем на системном уровне
        user::authUser();

        //Залогинелся
        if (user::$info['id']) {
            $result = array(
                'result' => 'redirect',
                'url' => $_SERVER['HTTP_REFERER'],
                'close' => true,
            );
        //Не подошло
        } else {
            user::deleteCookie('auth');
            $result = array(
                'result' => 'message',
                'message' => 'Не получилось, попробуйте ещё',
                'close' => false,
            );
        }
        //Ответ
        $this->answerInterface($values['interface'], $result);
    }

    //Регистрация пользователя
    public function registerUser($values, $conditions = false){

        //Здесь будем копить ошибки
        $errors = false;

        if (!strlen($values['title'])) $errors['title'] = 'Вы забыли указать Имя';
        if (!strlen($values['password'])) $errors['password'] = 'Вы забыли указать Пароль';
        if (strlen($values['password']) < 6) $errors['password'] = 'Пароль должен быть длиннее 6 символов';
        if (in_array($values['password'], $this->bad_passwords)) $errors['password'] = 'Вы ввели очень простой пароль, придумайте что-нибудь посложнее';
        if ($values['password'] == $values['title']) $errors['password'] = 'Пароль не может совпадать с именем на сайте';
        if ($values['password'] == $values['email']) $errors['password'] = 'Пароль не может совпадать с адресом электронной почты';
        if ($values['password'] !== $values['password_copy']) $errors['password_copy'] = 'Введённые пароли не совпадают';
        if (!strlen($values['title'])) $errors['title'] = 'Вы забыли указать Имя на сайте';
        if (!strlen($values['email'])) $errors['email'] = 'Вы забыли указать Адрес электронной почты';

        //Выводим ошибки
        if ($errors) {
            //Результирующий URL
            $result = array(
                'result' => 'error',
                'errors' => $errors,
                'close' => false,
            );
            //Ответ
            $this->answerInterface($values['interface'], $result);
        }


        if (!IsSet($values['login'])) $values['login'] = $values['title'];
        if (!IsSet($values['title'])) $values['title'] = $values['email'];

        //Проверка на уникальность логина и email`а
        $unique_login = model::makeSql(
            array(
                 'tables' => array($this->getCurrentTable('rec')),
                 'where' => array(
                     'and' => array(
                         '`login`="' . mysql_real_escape_string($values['login']) . '"',
                     ),
                 ),
            ),
            'getall'
        );
        $unique_login = !count($unique_login);

        //Проверка на уникальность логина и email`а
        $unique_email = model::makeSql(
            array(
                 'tables' => array($this->getCurrentTable('rec')),
                 'where' => array(
                     'and' => array(
                         '`email`="' . mysql_real_escape_string($values['email']) . '"',
                     ),
                 ),
            ),
            'getall'
        );
        $unique_email = !count($unique_email);

        //Если уникальный логин и email
        if ($unique_login && $unique_email) {
            if (!headers_sent()) header("HTTP/1.0 200 Ok");
            //Доп.поля
            $values['sid'] = $values['login'];
            $values['session_id'] = session_id();
            $values['active'] = 1;
            $values['moder'] = array();
            $values['admin'] = 0;
            $values['shw'] = 1;
            $values['show_phone'] = true;
            $values['show_icq'] = true;
            $values['show_twitter'] = true;
            $values['show_company'] = true;
            $values['subscribe_my'] = true;
            $values['subscribe_comments'] = true;
            $values['subscribe_friends'] = true;
            $values['region'] = array(model::pointDomainID());

            //Читаем размер рисунка
            $mime = GetImageSize(model::$config['path']['www'] . '/' . $values['avatar']);
            $size = filesize(model::$config['path']['www'] . '/' . $values['avatar']);

            $values['avatar'] = array(
                'tmp_name' => model::$config['path']['www'] . '/' . $values['avatar'],
                'name' => substr($values['avatar'], strrpos($values['avatar'], '/') + 1),
                'type' => $mime['mime'],
                'size' => $size,
            );

            $_POST['login'] = $values['login'];
            $_POST['password'] = $values['password'];

            //Заводим запись
            model::addRecord($this->info['sid'], 'rec', $values);
            //Авторизуем на системном уровне
            user::authUser();

            //Добавляем пустой фотоальбом "Неразобранное"
            $album_id = model::$modules['gallery']->getNextId('dir');
            $album = array(
                'id' => $album_id,
                'sid' => 'album' . $album_id,
                'title' => 'Неразобранное',
                'author' => user::$info['id'],
                'shw' => 1,
                'domain' => 'all',
            );
            model::addRecord('gallery', 'dir', $album);
            $sets = model::execSql('select * from `settings` where `domain`="|' . model::pointDomainID() . '|"', 'getall');
            $settings = array();
            foreach ($sets as $set)
            {
                $settings[$set['var']] = $set['value'];
            }
            //Пишем письмецо
            $head = 'Регистрация на сайте ' . model::$extensions['domains']->domain['title'] . '.';
            $body = 'Приветствуем, ' . $rec['title'] . '!

Кто-то, возможно Вы, зарегистрировались на сайте ' . model::$extensions['domains']->domain['title'] . '.
Если вы этого не делали - просто проигнорируйте это письмо.

' . $settings['register_mail'] . '

Логин: ' . $values['login'] . '
Пароль: ' . $values['password'] . '

----
Желаем вам приятного дня,
Администраниця сайта ' . model::$extensions['domains']->domain['title'] . '.
			';

            $email = model::initEmail();
            $email->send($values['email'], $head, $body);

            //Регистрируем действие пользователя
            $this->log_act('reg', false);

            //Результирующий URL
            return array(
                'result' => 'redirect',
                'url' => '/site/welcome.html',
                'close' => true,
            );
        }

        if (!$unique_login) {
            $errors['login'] = 'Такой логин уже используется на сайте';
        }
        if (!$unique_email) {
            $errors['email'] = 'Такой email уже используется на сайте';
        }

        //Выводим ошибки
        if ($errors) {
            $_SESSION['messages']['feedback'] = $errors;
            $_SESSION['messages']['feedback_memory'] = $memory;
        }

        //Результирующий URL
        $result = array(
            'result' => 'error',
            'errors' => $errors,
            'close' => false,
        );
        //Ответ
        $this->answerInterface($values['interface'], $result);

    }

    //Восстановление пароля
    public function recoverPassword($values, $conditions = false){
        $rec = model::makeSql(
            array(
                 'tables' => array($this->getCurrentTable('rec')),
                 'fields' => array('id', 'session_id', 'title', 'email'),
                 'where' => array('and' => array('`email`="' . mysql_real_escape_string($values['email']) . '"')),
            ),
            'getrow'
        );

        //Если ползователь найден
        if (IsSet($rec['id'])) {

            //URL для восстановления пароля
            $url = '/recover.php?i=' . md5($rec['session_id']);

            $head = 'Запрос о восстановлении пароля на сайте ' . $_SERVER['HTTP_HOST'] . '.';
            $body = 'Приветствуем, ' . $rec['title'] . '!

Кто-то, возможно Вы, запросил смену пароля на сайте ' . $_SERVER['HTTP_HOST'] . '.
Если вы этого не делали - просто проигнорируйте это письмо.

Для того, чтобы сменить пароль на сайте, пройдите по ссылке ниже:
http://' . $_SERVER['HTTP_HOST'] . $url . '

----
Желаем вам приятного дня,
Администраниця сайта ' . model::$extensions['domains']->domain['title'] . '.
			';

            mail($rec['email'], $head, $body);

            //Возвращаем откуда пришёл
            $result = array(
                'result' => 'message',
                'message' => 'Вам отправлено письмо с информацией о восстановлении пароля.',
                'close' => true,
            );

            //Пользователь не найден
        } else {
            //Возвращаем откуда пришёл
            $result = array(
                'result' => 'message',
                'message' => 'Пользователь с адресом ' . $values['email'] . ' не найден',
                'close' => true,
            );
        }
        //Ответ
        $this->answerInterface($values['interface'], $result);
    }

    //Обновление профиля
    public function updateProfile($values, $conditions = false){

        if (user::$info['id']) {

            //Доп.параметры
            $values['id'] = user::$info['id'];
            $values['sid'] = user::$info['login'];
            $values['date_modify'] = date("Y-m-d H:i:s");

            if (IsSet($values['web'])) $values['web'] = str_replace('http://', '', $values['web']);
            if (IsSet($values['blog'])) $values['blog'] = str_replace('http://', '', $values['blog']);

            if (substr_count($values['twitter'], '/'))
                $values['twitter'] = substr($values['twitter'], strpos($values['twitter'], '/') + 1);


            //Обновляем запись
            model::editRecord($this->info['sid'], 'rec', $values);

            //Результирующий URL
            $result = array(
                'result' => 'message',
                'message' => 'Ваш профиль обновлён',
                'close' => false,
            );
        } else {
            //Результирующий URL
            $result = array(
                'result' => 'message',
                'message' => 'Вы не авторизованы',
                'close' => false,
            );
        }
        //Ответ
        $this->answerInterface($values['interface'], $result);
    }

    //Смена пароля
    public function changePassword($values, $conditions = false){
        if (user::$info['id']) {

            //Здесь будем копить ошибки
            $errors = false;

            if ($values['password'] !== $values['password_copy']) $errors['password_copy'] = 'Введённые новые пароли не совпадают';

            if (!strlen($values['password'])) $errors['password'] = 'Вы забыли указать новый пароль';
            if (strlen($values['password']) < 6) $errors['password'] = 'Новый пароль должен быть длиннее 6 символов';
            if (in_array($values['password'], $this->bad_passwords)) $errors['password'] = 'Вы ввели очень простой новый пароль, придумайте что-нибудь посложнее';
            if ($values['password'] == user::$info['login']) $errors['password'] = 'Пароль не может совпадать с логином';
            if ($values['password'] == user::$info['title']) $errors['password'] = 'Пароль не может совпадать с именем на сайте';
            if ($values['password'] == user::$info['email']) $errors['password'] = 'Пароль не может совпадать с адресом электронной почты';
            if ($values['password'] == $values['old']) $errors['password'] = 'Новый пароль не должен совпадать со старым';
            if (model::$types['password']->encrypt($values['old']) != user::$info['password']) $errors['old'] = 'Старый пароль введён неверно';

            //Выводим ошибки
            if ($errors) {
                //Результирующий URL
                $result = array(
                    'result' => 'error',
                    'errors' => $errors,
                    'close' => false,
                );
                //Ответ
                $this->answerInterface($values['interface'], $result);
            }

            $values['id'] = user::$info['id'];
            $values['sid'] = user::$info['sid'];
            $values['password'] = $values['password'];

            //Обновляем запись
            model::editRecord($this->info['sid'], 'rec', $values);

            //Результирующий URL
            $result = array(
                'result' => 'message',
                'message' => 'Установлен новый пароль',
                'close' => false,
            );
        } else {
            //Результирующий URL
            $result = array(
                'result' => 'message',
                'message' => 'Вы не авторизованы',
                'close' => false,
            );
        }
        //Ответ
        $this->answerInterface($values['interface'], $result);
    }

	// Пригласить друга
	public function inviteUser($values){
		
		// Высылаем ему приглашение
		$text = '
			<p>Добрый день, '.strip_tags($values['title']).'!</p>
			<p>'.(user::$info['sex'] == 'женский'?'Ваша знакомая':'Ваш знакомый').' <strong>'.user::$info['title'].'</strong> приглашает вас присоединиться к социальной сети "Будь Мобильным"!</p>
			<p>Посмотрите на <a href="http://'.$_SERVER['HTTP_HOST'].user::$info['url'].'.html">страницу '.user::$info['title'].'</a>, нравится?</a></p>
			<p>
				<h3><a href="http://'.$_SERVER['HTTP_HOST'].'/users.registration.html">Присоединиться к проекту</a></h3>
			</p>
			<p>'.model::$settings['about'].'</p>
			<hr />
			<p>С уважением, Администрация "Будь Мобильным".</p>
		';
		
		$email = model::initEmail();
		$email->send($values['email'], user::$info[ $values['title'] ].' приглашает вас на "Будь Мобильным".', $text, 'html');
		
		return 'ok';
		
		
	}
	
	// Удаление профиля пользователя
	public function deleteMe($values){
        
		//Здесь будем копить ошибки
        $errors = false;

		if (!strlen($values['password'])) $errors['password'] = 'Вы забыли указать Пароль';
		if( model::$types['password']->encrypt( $values['password'] ) != user::$info['password'] ) $errors['password'] = 'Пароль указан не верно';
		
        //Выводим ошибки
        if ($errors) {
            //Результирующий URL
            $result = array(
                'result' => 'error',
                'errors' => $errors,
                'close' => false,
            );
            //Ответ
            $this->answerInterface($values['interface'], $result);
        }
		
		// Сначала удаляем всю информацию пользователя на сайте
		if( $values['delete_info'] ){
			
			// Удаляем записи
			$delete_recs = array();
			foreach( model::$modules as $module_sid => $module )
				foreach( $module->structure as $structure_sid => $structure ){
					$sql = 'update `'.model::$modules[ $module_sid ]->getCurrentTable( $structure_sid ).'` set `shw`=0 where `author`='.intval( user::$info['id'] ).'';
					$recs = model::execSql($sql, 'getall');
					if( count( $recs ) )
						$delete_recs = array_merge( $delete_recs, $recs );
				}
		}
		
		// Удаляем профиль пользователя
		if( $values['delete_user'] ){
			model::execSql('update `users` set `active`=0, `shw`=0 where `id`='.intval( user::$info['id'] ).' limit 1','update');
		}
		
		// Разавторизовываем пользователя
		user::logout();
		
		// Перенаправляем на главную страницу сайта
		return array(
			'result' => 'redirect',
			'url' => '/',
		);
		
	}
	
    //Предопределяем таблицу
    public function getCurrentTable(){
        return $this->table;
    }
	
	public function getPopularTags( $params ){
	
		// Соберём все действия, которые я делал
		$all = array();
		foreach( acts_module::$types as $type_sid => $type )
			foreach( model::$modules as $module_sid => $module )
				if( IsSet( $module->structure['rec']['fields']['tags'] ) )
					if( IsSet( $module->structure['rec']['fields'][ $type_sid ] ) ){
			
						$sql = 'select `tags` from `'.$module->getCurrentTable('rec').'` where `'.$type_sid.'` LIKE "%|'.$params['id'].'|%"';
						$recs = model::execSql($sql, 'getall');
						foreach( $recs as $rec ){
							$tags = explode('|', $rec['tags']);
							foreach($tags as $tag)
								if( strlen( $tag ) )
									$all[ $tag ] += 1;
						}
					}
		
		arsort( $all );
		$tags = array_keys( $all );
		
		if( count( $tags ) )
			$tags = model::$types['tags']->getValueExplode( '|'.implode('|', $tags).'|');
		
		return $tags;	
	}

}

?>
