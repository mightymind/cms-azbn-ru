<?

function showEntityWithChildren(&$catalog,$entity_id) {
	echo '<div class="leftmenu-catalog-item" >
		<a href="/gallery/view/'.$catalog['list'][$entity_id]['id'].'/" >'.$catalog['list'][$entity_id]['title'].'</a>';
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

$item_list=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_gallery']."` ORDER BY id");

$catalog=array(
	'list'=>array(),
	'structure'=>array()
	);

if(mysql_num_rows($item_list)) {
	while($row=mysql_fetch_array($item_list)) {
		$catalog['list'][$row['id']]=$row;
		$catalog['structure'][$row['parent']][$row['id']]=&$catalog['list'][$row['id']];
		}
	mysql_data_seek($item_list,0);
	}

if(count($catalog['structure'][0])) {
	foreach($catalog['structure'][0] as $index=>$entity) {
		showEntityWithChildren($catalog,$index);
		}
	}
?>
<!-- Пустой файл модуля. НЕ УДАЛЯТЬ! -->