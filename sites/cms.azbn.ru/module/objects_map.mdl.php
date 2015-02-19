<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>

var groups = [
	<?
	if(count($param['item_list'])) {	
		foreach($param['item_list'] as $row) {
	?>
	{
		name: "<?=$row['title'];?>",
		style: "islands#redIcon",
		items: [
			<?
			if(count($param['item_list'][$row['id']]['geopoint_list'])) {
				foreach($param['item_list'][$row['id']]['geopoint_list'] as $grow) {
				?>
				{
					id: "<?=$grow['id']?>",
					center: [<?=$grow['lat']?>,<?=$grow['lng']?>],
					name: "<?=$grow['title']?>",
					img: "<?=$grow['img']?>",
				},
				<?
					}
				}
			?>
				],
		},
	<?
			}
		}
	?>
	];

function init() {

	// Создание экземпляра карты.
	var myMap = new ymaps.Map('obj-map', {
			center: [52.965679, 36.079818],
			zoom: 14,
		}),
		// Контейнер для меню.
		menu = $('<ul class="menu"/>');
		
	for (var i = 0, l = groups.length; i < l; i++) {
		createMenuGroup(groups[i]);
	}

	function createMenuGroup (group) {
		// Пункт меню.
		var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),
		// Коллекция для геообъектов группы.
			collection = new ymaps.GeoObjectCollection(null, { preset: group.style }),
		// Контейнер для подменю.
			submenu = $('<ul class="submenu"/>');

		// Добавляем коллекцию на карту.
		myMap.geoObjects.add(collection);

		// Добавляем подменю.
		menuItem
			.append(submenu)
			// Добавляем пункт в меню.
			.appendTo(menu)
			// По клику удаляем/добавляем коллекцию на карту и скрываем/отображаем подменю.
			.find('a')
			.toggle(function () {
				myMap.geoObjects.remove(collection);
				submenu.hide();
			}, function () {
				myMap.geoObjects.add(collection);
				submenu.show();
			});
		for (var j = 0, m = group.items.length; j < m; j++) {
			createSubMenu(group.items[j], collection, submenu);
		}
	}

	function createSubMenu (item, collection, submenu) {
		// Пункт подменю.
		var submenuItem = $('<li><a href="/objects/view/'+item.id+'/">' + item.name + '</a></li>'),
		// Создаем метку.
			placemark = new ymaps.Placemark(item.center, {
				balloonContent: '<center><p><b>' + item.name + '</b></p><p><a href="/objects/view/'+item.id+'/"><img src="'+item.img+'" /></a></p></center>',
				iconContent: item.name,
				}, {
					preset: 'islands#blackStretchyIcon',
					});

		// Добавляем метку в коллекцию.
		collection.add(placemark);
		// Добавляем пункт в подменю.
		submenuItem
			.appendTo(submenu)
			// При клике по пункту подменю открываем/закрываем баллун у метки.
			.find('a')
			.toggle(function () {
				placemark.balloon.open();
			}, function () {
				placemark.balloon.close();
			});
	}

	// Добавляем меню в тэг BODY.
	//menu.appendTo($('#obj-list'));
	// Выставляем масштаб карты чтобы были видны все группы.
	myMap.setBounds(myMap.geoObjects.getBounds());
	}
	
ymaps.ready(init);
</script>