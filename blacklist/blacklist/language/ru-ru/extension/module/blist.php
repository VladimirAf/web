<?php

$_['heading_title']        = 'Blist';

// Text
$_['text_extension']       = 'Модули';
$_['text_success']         = 'Настройки модуля обновлены!';
$_['text_settings']        = '<i class="fa fa-cog" aria-hidden="true"></i> Настройки';
$_['text_list']            = '<i class="fa fa-user-times" aria-hidden="true"></i> Бан-лист';
$_['text_on_list']		   = 'Покупатель найден бан-листе!';

$_['text_info']			   = '<i class="fa fa-exclamation-circle"></i> Вы можете добавить этого покупателя в черный список';
$_['text_add']			   = 'Добавить';

$_['text_blacklist_info']  = 'Черный список покупателей';
$_['text_order']	       = 'Номер заказа';
$_['text_store']	       = 'Магазин';
$_['text_firstname']       = 'Имя';
$_['text_lastname']	       = 'Фамилия';
$_['text_email']	       = 'E-mail';
$_['text_phone']	       = 'Телефон';
$_['text_comment']	       = 'Комментарий менеджера';
$_['text_db_store']	       = 'Использовать базу магазина';
$_['text_db_external']     = 'Использовать внешнюю базу';
$_['text_check_db']        = 'Проверить подключение';
$_['text_create_db']       = 'Создать таблицы';
$_['text_create']	       = 'Таблицы успешно созданы!';
$_['text_alert_info']      = 'При изменении, удалении или создании записи в бан-листе учитываются текущие настройки. К примеру, если вы переключили тип базы, новые записи попадут в базу, которая на данный момент выбрана.';
$_['text_save']			   = 'Сохранить';
$_['text_email_ignore']	   = 'Игнорируемые email адреса (через запятую)';

// Entry
$_['entry_base_type']         = 'База данных';
$_['entry_status']            = 'Статус';
$_['entry_external_server']	  = 'Сервер';
$_['entry_external_user']	  = 'Пользователь';
$_['entry_external_pwd']	  = 'Пароль';
$_['entry_external_port']	  = 'Порт';
$_['entry_external_database'] = 'База';

// Error
$_['e_permission'] = 'У вас нет прав для управления этим модулем!';
$_['e_db']		   = 'Вы не создали таблицы модуля!';
$_['e_hostname']   = $_['e_username'] = $_['e_password'] = 
$_['e_database']   = 'Поле должно быть заполнено!';
$_['e_connected']  = 'Не удалось подключится к удаленной базе, проверьте доступы!';

$_['e_cutomer_edit']    = 'Не получилось обновить данные клиента!'; 
$_['e_customer_fileds'] = 'Должно быть заполнено хотя бы одно поле с информацией о клиенте! <br> Номер заказа и Телефон должны быть только цифры!'; 
$_['e_customer_load']   = 'Не получилось найти данные клиента!';