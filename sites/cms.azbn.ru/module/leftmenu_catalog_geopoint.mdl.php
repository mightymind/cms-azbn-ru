<?

function showEntityWithChildren(&$catalog,$entity_id) {
	echo '<div class="leftmenu-catalog-item" >
		<a href="/geopoint/cat/'.$catalog['list'][$entity_id]['id'].'/" >'.$catalog['list'][$entity_id]['title'].'</a>';
	if(count($catalog['structure'][$entity_id])) {
		echo '<div class="children-items" >';
		foreach($catalog['structure'][$entity_id] as $index=>$entity) {
			showEntityWithChildren($catalog,$index);
			}
		echo '</div>';
		}
	if($catalog['list'][$entity_id]['parent']==0) {
		echo '<div class="clear20" ></div></div>';
		} else {
			echo '</div>';
			}
	}

$catalog=array(
	'list'=>array(),
	'structure'=>array()
	);

if(count($param['item_list'])) {	
	foreach($param['item_list'] as $row) {
		$catalog['list'][$row['id']]=$row;
		$catalog['structure'][$row['parent']][$row['id']]=&$catalog['list'][$row['id']];
		}
	}

if(count($catalog['structure'][0])) {
	foreach($catalog['structure'][0] as $index=>$entity) {
		showEntityWithChildren($catalog,$index);
		}
	}
?>
<!-- Пустой файл модуля. НЕ УДАЛЯТЬ! -->