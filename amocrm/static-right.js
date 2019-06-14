
function DisallowCloseLead() {
	var self = this;
	this.lead_id	   		 = null;
	this.responsible_user_id = null;
	this.tomorrow_date 		 = null;
	this.cdblocked 	 = 0;
	this.element1 = null;
	this.element2 = null;
	this.init = function () {
		var user = UtilsDev.getCurrentUser();
		this.element1 = document.getElementsByClassName('left-menu');
		this.element2 = document.getElementsByClassName('card-fields__top-back');
        this.element1 = self.element1[0];
        this.element2 = self.element2[0];
		this.lead_id	   		 = UtilsDev.getLeadId();
		this.responsible_user_id = user.id;
		this.tomorrow_date 		 = new Date();
		self.tomorrow_date.setDate(self.tomorrow_date.getDate()+1);
		this.tomorrow_date 		 = self.tomorrow_date.getDate()+'.'+(self.tomorrow_date.getMonth()+1)+'.'+self.tomorrow_date.getFullYear()+' '+self.tomorrow_date.getHours()+':'+self.tomorrow_date.getMinutes();
		self.fillUserList();
		this.modal_okno 		 = '<div class="modal modal-list modal-todo">'+
									'<div class="modal-scroller custom-scroll">'+
									'<div class="modal-body" style="margin-top: -322.5px;margin-left: -355px;z-index: 97;">'+
									'<div class="modal-body__inner">'+
									'<div class="todo-form">'+
									'<div class="card-task__linked-for-todo   card-task__linked-for-todo_in-edit" data-element-type="2">'+
									'<div class="card-task__linked-for-todo-inner">'+
									'<span class="js-unlink card-task__linked-for-todo-unlink">'+
									'Открепить</span>'+
									'</div>'+
									'<div class="control-wrapper control--suggest card-task__linked-for-todo-suggest" data-no-filter="y" data-entity="null" style="">'+
									'<input autocomplete="off" name="" class="text-input control--suggest--input js-control--suggest--input-ajax js-todo-form-suggest" id="cart-task_change_entity" type="hidden" placeholder="Контакт, сделка или покупатель" value="Сделка #'+self.lead_id+'" data-value-id="'+self.lead_id+'" data-type="1" data-url="/ajax/todo/search/" data-params="search_string=#q#" data-no-filter="y" data-entity="null" data-val="сделка">'+
									'</div>'+
									'<input type="hidden" name="element_id" value="'+self.lead_id+'">'+
									'</div>'+
									'<div class="feed-compose feed-compose_task feed-compose_task-modal">'+
									'<div class="js-control-contenteditable control-contenteditable card-task__actions">'+
									'<div class="js-control-contenteditable-clearer control-contenteditable__clearer">'+
									'<div class="card-task__actions__date-user">'+
									'<span class="card-task__actions__date-user__dates">'+
									'<div class="tasks-date " data-responsible="3423361" data-id="" data-type="1" data-title="">'+
									'<input type="hidden" name="tasks-type" value="1">'+
									'<input type="hidden" name="duration" value="">'+
									'<input type="hidden" name="time" value="23:59">'+
									'<div class="tasks-date__caption ">'+
									'<span class="tasks-date__caption-date">'+
									'Завтра</span>'+
									'<span class="tasks-date__caption-time" data-hide-time="1">'+
									'</span>'+
									'</div>'+
									'<div class="tasks-date__wrapper ">'+
									'<div class="tasks-date__controls">'+
									'<div class="tasks-date__controls-date js-control-date-tasks-date js-tasks-date-input-bg" data-calendar-id="5642">'+
									'<input class="tasks-date__controls-date-input allow-click" name="date" value="22.04.2019">'+
									'</div>'+
									'<div class="tasks-date__controls-time js-tasks-date-input-bg">'+
									'<input class="tasks-date__controls-time-input js-tasks-date-time-input js-control-format-time" value="" placeholder="Весь день" style="width: 64px;">'+
									'</div>'+
									'</div>'+
									'<div class="tasks-date__wrapper-inner">'+
									'<div class="tasks-date__list custom-scroll">'+
									'<div class="tasks-date__list__item js-tasks-date-preset" data-period="today">'+
									'Сегодня</div>'+
									'<div class="tasks-date__list__item js-tasks-date-preset" data-period="tomorrow">'+
									'Завтра</div>'+
									'<div class="tasks-date__list__item js-tasks-date-preset" data-period="before_end_of_week">'+
									'До конца недели</div>'+
									'<div class="tasks-date__list__item js-tasks-date-preset" data-period="next_week">'+
									'Через неделю</div>'+
									'<div class="tasks-date__list__item js-tasks-date-preset" data-period="next_month">'+
									'Через месяц</div>'+
									'<div class="tasks-date__list__item js-tasks-date-preset" data-period="next_year">'+
									'Через год</div>'+
									'</div>'+
									'<div class="tasks-date__datetime">'+
									'<div class="tasks-date__calendar custom-scroll" id="tasks_date_calendar_5642">'+
									'<div class="kalendae">'+
									'<div class="k-calendar" data-cal-index="0" data-datestart="2019-04-01">'+
									'<div class="k-title">'+
									'<a class="k-btn-previous-year">'+
									'</a>'+
									'<a class="k-btn-previous-month">'+
									'</a>'+
									'<a class="k-btn-next-year">'+
									'</a>'+
									'<a class="k-btn-next-month">'+
									'</a>'+
									'<span class="k-caption">'+
									'Апрель 2019</span>'+
									'</div>'+
									'<div class="k-header ">'+
									'<span data-day="0" class="">'+
									'Пн</span>'+
									'<span data-day="1" class="">'+
									'Вт</span>'+
									'<span data-day="2" class="">'+
									'Ср</span>'+
									'<span data-day="3" class="">'+
									'Чт</span>'+
									'<span data-day="4" class="">'+
									'Пт</span>'+
									'<span data-day="5" class="">'+
									'Сб</span>'+
									'<span data-day="6" class="">'+
									'Вс</span>'+
									'</div>'+
									'<div class="k-days">'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-01">'+
									'1</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-02">'+
									'2</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-03">'+
									'3</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-04">'+
									'4</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-05">'+
									'5</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-06">'+
									'6</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-07">'+
									'7</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-08">'+
									'8</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-09">'+
									'9</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-10">'+
									'10</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-11">'+
									'11</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-12">'+
									'12</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-13">'+
									'13</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-14">'+
									'14</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-15">'+
									'15</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-16">'+
									'16</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-17">'+
									'17</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-18">'+
									'18</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-19">'+
									'19</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-20">'+
									'20</span>'+
									'<span class="k-in-month k-active k-today" data-date="2019-04-21">'+
									'21</span>'+
									'<span class="k-selected k-in-month k-active" data-date="2019-04-22">'+
									'22</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-23">'+
									'23</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-24">'+
									'24</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-25">'+
									'25</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-26">'+
									'26</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-27">'+
									'27</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-28">'+
									'28</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-29">'+
									'29</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-30">'+
									'30</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-01">'+
									'1</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-02">'+
									'2</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-03">'+
									'3</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-04">'+
									'4</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-05">'+
									'5</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-06">'+
									'6</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-07">'+
									'7</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-08">'+
									'8</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-09">'+
									'9</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-10">'+
									'10</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-11">'+
									'11</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-12">'+
									'12</span>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'<div class="kalendae">'+
									'<div class="k-calendar" data-cal-index="0" data-datestart="2019-04-01">'+
									'<div class="k-title">'+
									'<a class="k-btn-previous-year">'+
									'</a>'+
									'<a class="k-btn-previous-month">'+
									'</a>'+
									'<a class="k-btn-next-year">'+
									'</a>'+
									'<a class="k-btn-next-month">'+
									'</a>'+
									'<span class="k-caption">'+
									'Апрель 2019</span>'+
									'</div>'+
									'<div class="k-header ">'+
									'<span data-day="0" class="">'+
									'Пн</span>'+
									'<span data-day="1" class="">'+
									'Вт</span>'+
									'<span data-day="2" class="">'+
									'Ср</span>'+
									'<span data-day="3" class="">'+
									'Чт</span>'+
									'<span data-day="4" class="">'+
									'Пт</span>'+
									'<span data-day="5" class="">'+
									'Сб</span>'+
									'<span data-day="6" class="">'+
									'Вс</span>'+
									'</div>'+
									'<div class="k-days">'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-01">'+
									'1</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-02">'+
									'2</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-03">'+
									'3</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-04">'+
									'4</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-05">'+
									'5</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-06">'+
									'6</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-07">'+
									'7</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-08">'+
									'8</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-09">'+
									'9</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-10">'+
									'10</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-11">'+
									'11</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-12">'+
									'12</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-13">'+
									'13</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-14">'+
									'14</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-15">'+
									'15</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-16">'+
									'16</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-17">'+
									'17</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-18">'+
									'18</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-19">'+
									'19</span>'+
									'<span class="k-in-month k-active k-before-today" data-date="2019-04-20">'+
									'20</span>'+
									'<span class="k-in-month k-active k-today" data-date="2019-04-21">'+
									'21</span>'+
									'<span class="k-selected k-in-month k-active" data-date="2019-04-22">'+
									'22</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-23">'+
									'23</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-24">'+
									'24</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-25">'+
									'25</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-26">'+
									'26</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-27">'+
									'27</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-28">'+
									'28</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-29">'+
									'29</span>'+
									'<span class="k-in-month k-active" data-date="2019-04-30">'+
									'30</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-01">'+
									'1</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-02">'+
									'2</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-03">'+
									'3</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-04">'+
									'4</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-05">'+
									'5</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-06">'+
									'6</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-07">'+
									'7</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-08">'+
									'8</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-09">'+
									'9</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-10">'+
									'10</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-11">'+
									'11</span>'+
									'<span class="k-out-of-month k-active" data-date="2019-05-12">'+
									'12</span>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'<div class="tasks-date__time-planner js-tasks-date-timeplanner">'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</span>'+
									'<span class="feed-compose__due">'+
									'для</span>'+
									'<span id="feed_compose_user" class="card-task__actions__date-user__user feed-compose-user">'+
									'<div class="feed-compose-user js-feed-users">'+
									'<div class="js-multisuggest-list">'+
									'<div class="feed-compose-user__name" onclick="$(\'#user-select-list\').show()">'+user.name+
									'</div>'+
									'</div>'+
									'</div>'+
									'</span>'+
									'<input type="hidden" class="js-task-main_user" name="main_user" value="3423361">'+
									':&nbsp;<div class="card-task__type-wrapper">'+
									'<div class="card-task__type">'+
									'<span class="task-type-name-with-icon">'+
									'<span class="task-type-name-with-icon__icon card-task__type-icon">'+
									'<span class="icon icon-follow-up">'+
									'</span>'+
									'</span>'+
									'<span class="task-type-name-with-icon__text" title="Связаться с клиентом">'+
									'Связаться с клиентом</span>'+
									'</span>'+
									'</div>'+
									'<div class="card-task__type-opened" style="display: none">'+
									'<ul class="card-task__types custom-scroll">'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_1" checked="checked" value="1" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_1">'+
									'<span class="task_type_select__icon icon icon-inline icon-follow-up">'+
									'</span>'+
									'Связаться с клиентом</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_2" value="2" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_2">'+
									'<span class="task_type_select__icon icon icon-inline icon-case-red">'+
									'</span>'+
									'Встреча</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490407" value="490407" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490407">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Рекламация</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490410" value="490410" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490410">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Доки на отгрузку</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490413" value="490413" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490413">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Изготовление?</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490416" value="490416" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490416">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'фото/отзыв</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490419" value="490419" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490419">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'макет</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490422" value="490422" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490422">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'аппликация</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490425" value="490425" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490425">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'решение по закуп</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490428" value="490428" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490428">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'контроль</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_490431" value="490431" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_490431">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'оплата счета</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_625948" value="625948" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_625948">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Миграция</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_840040" value="840040" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_840040">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Назначить замер</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_840043" value="840043" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_840043">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Назначить замер</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_840079" value="840079" name="type">'+
									'<label class="card-task__types-item-label " for="task_type_688_840079">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims" style="fill: #568FFA">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Смета</label>'+
									'</li>'+
									'<li class="card-task__types-item">'+
									'<input type="radio" class="hidden" id="task_type_688_custom" value="custom" name="type">'+
									'<label class="card-task__types-item-label card-task__types-item-label_custom" for="task_type_688_custom">'+
									'<span class="task_type_select__icon">'+
									'<svg class="svg-icon svg-tasks--types-icons--0-dims">'+
									'<use xlink:href="#tasks--types-icons--0">'+
									'</use>'+
									'</svg>'+
									'</span>'+
									'Другой<input type="text" name="task_type_name" class="card-task__types-item-custom-input" maxlength="16">'+
									'<input type="hidden" name="icon_id">'+
									'<input type="hidden" name="icon_color">'+
									'</label>'+
									'</li>'+
									'</ul>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'<input type="hidden" class="js-control-contenteditable-input " name="body" value="">'+
									'<div id="" class="control-contenteditable__area " contenteditable="true" data-hint="" style="padding-left: 439px;">'+
									'</div>'+
									'</div>'+
									'<div class="feed-compose__actions card-task__buttons">'+
									'<button type="1" class="button-input js-task-submit feed-note__button" tabindex="-1" id="">'+
									'<span class="button-input-inner ">'+
									'<span class="button-input-inner__text allow-click">'+
									'Поставить </span>'+
									'</span>'+
									'</button>'+
									'</div>'+
									'</div>'+self.user_list+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>';
			      
						self.getTasks(0);
	};
	this.chooseTaskType = function (parentElement) {
		$('input[name="tasks-type"]').val($(parentElement).find('input[name="type"]').val());
	};
	this.fillUserList = function () {
		var users = UtilsDev.getAllUsers();
		var userListHtml = '';

		users.forEach(function (user) {
			// console.log(user.id);
			userListHtml += '<div class="users-select__body__item" id="select_users__user-'+user.id+'">'+
							'<div class="multisuggest__suggest-item js-multisuggest-item true" data-group="group_'+user.group_id+'" data-id="'+user.id+'" data-name="'+user.name+'">'+user.name+
								'<span data-id="'+user.id+'" class="control-user_state">'+
									'</span>'+
									'</div>'+
									'</div>';
		});

		this.user_list = '<div id="user-select-list" class="multisuggest__suggest-wrapper suggest-manager users-select-suggest" style="top: 20%;right: 50%;margin-top: 30px;margin-right: -70px;display:none" data-is-suggest="y" data-multisuggest-id="9280">'+
									'<div class="multisuggest__suggest js-multisuggest-suggest custom-scroll" style="height: 221px; max-height: 300px;">'+
									'<div class="users-select-row">'+
									'<div class="users-select-row__inner group-color-wrapper ">'+
									'<div class="users-select__head group-color " data-title="Отдел продаж" data-group="y" data-id="group_0" style="height: 35px;">'+
									'<div class="users-select__head-title outside-top outside" style="width: 250px; top: 0px;">'+
									'<span class="users-select__head-title-text">'+
									'Все пользователи</span>'+
									'</div>'+
									'</div>'+
									'<div class="users-select__body" data-id="group_all">'+
									userListHtml+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>'+
									'</div>';

	};

	this.chooseUser = function (choosedUser) {
		console.log($(choosedUser).data('id'));
		self.responsible_user_id=$(choosedUser).data('id');
		$('.feed-compose-user__name').text($(choosedUser).data('name'));
		$('#user-select-list').hide();
	};
	this.addTask = function () {
	  $.post('/api/v2/tasks', {
	    add:[{
	       'element_id':self.lead_id, 
	       'element_type':"2", 
	       'task_type':$('input[name="tasks-type"]').val(), 
	       'text':$('input[name="body"]').val(),
	       'responsible_user_id':self.responsible_user_id,
	       'complete_till_at':$('.tasks-date__caption-date').text() === 'Завтра' ?  self.tomorrow_date : $('.tasks-date__caption-date').text()+' '+$('.tasks-date__caption-time').text().split('-')[0],
	       'duration':$('input[name="duration"]').val()? $('input[name="duration"]').val():0
	        }]
	      });
	  	$('.modal-todo').hide();
    	self.element1.onclick = self.element1.onmousedown = self.element2.onclick = self.element2.onmousedown = null;
		$(document).off('click','.left-menu',self.blockMouse);
		$(document).off('mousedown','.left-menu',self.blockMouse);
		window.location.reload();
	};
	this.getTasks = function(allowtasks) {
		$.getJSON('/api/v2/tasks?type=lead&element_id='+self.lead_id).done(function (res) {
					var i=0;
					self.cdblocked = 0;
                	self.element1.onclick = self.element1.onmousedown = self.element2.onclick = self.element2.onmousedown = null;
		            if(typeof res !== 'undefined')  		
			            res._embedded.items.some(function (item) {
			                 if(!item.is_completed) i++; });
		            if(i <= allowtasks ){
		            		window.addEventListener('popstate', self.blockMouseAfterUnload,false);
		            		$(document).off('mouseenter','.nav__menu__item');
		                	self.element1.onclick = self.element1.onmousedown = self.element2.onclick = self.element2.onmousedown = self.blockMouse;
		            		self.cdblocked = 1;
		            	}
		              });
	};
	this.blockMouseAfterUnload = function () {
		if(self.cdblocked)
		  		window.history.go(1);
	};
	this.blockMouse = function handler() { 
	if(window.location.pathname.indexOf('leads/detail')<0)
		return false;
		                	  	
    var $button = $('<button>', {
    	class:"button-input feed-note__button",
    	style:"margin:2px;"
	}).text('OK');
    UtilsDev.alert('Невозможно покинуть сделку, нужно поставить следующую задачу', '<div class="blocker-modal-window">'+$button[0].outerHTML+'</div>');
	$('body').on('mouseup','.blocker-modal-window button,.modal-window-map .modal-body__close',self.closeModal);
	if($('.modal-todo').length == 0) {
        $('#card_holder').before(self.modal_okno);
        // $('#card_holder').before(self.user_list);
    }
     else $('.modal-todo').show();
				                         
						  };
	this.closeModal = function () {
		$('.modal-window-map .modal-body__close').trigger('click');
	};
}

if (UtilsDev.checkArea('lcard') 
	&& UtilsDev.isAdmin() && UtilsDev.settingsRawLk.block_notasksdeal_enable
) {
	var blocker = new DisallowCloseLead();
	$(document).off('mouseup.AddDealCardTask','.js-task-submit');
	$(document).on('mouseup.AddDealCardTask','.js-task-submit',function() {
		blocker.addTask(0);
	});

	$(document).off('mousedown.tasksform','.card-task__types-item');
	$(document).on('mousedown.tasksform','.card-task__types-item',function () {
		blocker.chooseTaskType($(this));
	});
	$(document).on('mousedown','.multisuggest__suggest-item',function () {
		blocker.chooseUser($(this));
	});
	
	$(document).ready(function () {

		blocker.init();
		blocker.fillUserList();
		$('.left-menu').click();
	});
	$(document).off('mouseup.IsTask','.js-task-result-button,.button-cancel.js-note-delete-btn');
	$(document).on('mouseup.IsTask','.js-task-result-button,.button-cancel.js-note-delete-btn',function() {
		blocker.getTasks(1);
		
	});
	$(document).on('click','.multisuggest__suggest-wrapper',function(){
		$('.multisuggest__suggest-wrapper').hide();
	});

}


