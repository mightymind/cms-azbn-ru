<?
$uniq=$this->FE->randstr(12);
?>
<!-- Редактор -->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>

var map_<?=$uniq;?>;
var point_<?=$uniq;?>;

ymaps.ready(init);

function init () {
	map_<?=$uniq;?> = new ymaps.Map("div-GPMap-<?=$uniq;?>", {
		center: [<?=$param['map_form']['center']['lat'];?>, <?=$param['map_form']['center']['lng'];?>],
		zoom: <?=$param['map_form']['center']['zoom'];?>,
		});
	
	point_<?=$uniq;?> = new ymaps.GeoObject({
		geometry: {
			type: "Point",
			coordinates: [<?=$param['map_form']['point']['lat'];?>, <?=$param['map_form']['point']['lng'];?>],
			},
		properties: {
			iconContent: '<?=$param['map_form']['point']['title'];?>',
			hintContent: '<?=$param['map_form']['point']['preview'];?>',
            }
        }, {
			preset: 'islands#blackStretchyIcon',
			//draggable: true,
			}
		);
	
	map_<?=$uniq;?>.events.add('click', function(e) {
		if (!map_<?=$uniq;?>.balloon.isOpen()) {
			var coords = e.get('coords');
			map_<?=$uniq;?>.balloon.open(coords, {
				contentHeader: 'Новая отметка',
				contentBody: '<p>Координаты щелчка: ' + [coords[0].toPrecision(8),coords[1].toPrecision(8)].join(', ') + '</p>',
				//contentFooter:'<sup>Щелкните еще раз</sup>',
				});
			
			map_<?=$uniq;?>.geoObjects.remove(point_<?=$uniq;?>);
			point_<?=$uniq;?> = new ymaps.GeoObject({
				geometry: {
					type: "Point",
					coordinates: [coords[0].toPrecision(8),coords[1].toPrecision(8)],
					},
				properties: {
					iconContent: '<?=$param['map_form']['point']['title'];?>',
					hintContent: '<?=$param['map_form']['point']['preview'];?>',
					}
				}, {
					preset: 'islands#blackStretchyIcon',
					//draggable: true,
					}
				);
			map_<?=$uniq;?>.geoObjects.add(point_<?=$uniq;?>);
			
			$('#div-GPMap-lat-<?=$uniq;?>').val(coords[0].toPrecision(8));
			$('#div-GPMap-lng-<?=$uniq;?>').val(coords[1].toPrecision(8));
			} else {
				map_<?=$uniq;?>.balloon.close();
				}
		});
	
	map_<?=$uniq;?>.geoObjects.add(point_<?=$uniq;?>);
	
	}

$(document).ready(function() {
	
	
	
	});

</script>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<style>
		#div-GPMap-<?=$uniq;?> {
			height:400px;
			}
		</style>
		
		<label >Отметка объекта на карте</label>
		
		<div id="div-GPMap-<?=$uniq;?>" ></div>
	
	</div>
	
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
		
		<label >Широта</label>
		<input type="text" class="form-control" id="div-GPMap-lat-<?=$uniq;?>" name="lat" value="<?=$param['map_form']['point']['lat'];?>" />
	
	</div>
	
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
		
		<label >Долгота</label>
		<input type="text" class="form-control" id="div-GPMap-lng-<?=$uniq;?>" name="lng" value="<?=$param['map_form']['point']['lng'];?>" />
	
	</div>
	
	<div class="clear20" ></div>
	
</div>