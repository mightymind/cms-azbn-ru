<?
// вывод списка невыполненных заданий
$updates=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_log']."` WHERE
	created_at>'".($this->FE->date-2592000)."'
	AND
	user='".$_SESSION['user']['id']."'
	AND
	(
		type='create'
		OR
		type='update'
	)
	ORDER BY id DESC LIMIT 25");
if(mysql_num_rows($updates)) {
	$dbls=array();
	?>
	
	<h4>Последние ваши действия</h4>
	<ul class="list-group">
	<?
	while($row=mysql_fetch_array($updates)) {
		//$row['user_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='".$row['user']."'");
		if(!$dbls[$row['type'].'_'.$row['el_type'].'_'.$row['el_id']]) {
		$dbls[$row['type'].'_'.$row['el_type'].'_'.$row['el_id']]=1;
		$row['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$row['el_type']]."` WHERE id='".$row['el_id']."'");
		
		switch($row['el_type']) {
				case 'user':
				case 'profile':{
					$row['title']=$row['item_id']['view_as'];
				}
				break;
				
				case 'alias':{
					$row['title']=$row['item_id']['req'];
				}
				break;
				
				/*
				case 'usertask':{
					$row['title']=$row['item_id']['name'];
				}
				break;
				*/
				
				case 'userright':{
					$row['title']=$row['item_id']['right_name'];
				}
				break;
				
				case 'apiapp':{
					$row['title']=$row['item_id']['login'];
				}
				break;
				
				case 'feedback':{
					$row['title']=$row['item_id']['view_as'].', '.$row['item_id']['email'];
				}
				break;
				
				case 'faq':{
					$row['title']=$row['item_id']['main_info'];
				}
				break;
				
				default:{
					$row['title']=$row['item_id']['title'];
				}
				break;
			}
		
		switch($row['type']) {
			
			case 'create':{
				$what='создано';
				$class='danger';
			}
			break;
			
			case 'update':{
				$what='обновлено';
				$class='warning';
			}
			break;
			
			default:{
				$what='';
			}
			break;
		}
		
		?>
		
		<li class="list-group-item">
			<span class="pull-left label label-info"><?=date("d.m.Y H:i",$row['created_at']);?></span>
			<span class="pull-right label label-<?=$class;?>"><?=$what;?></span>
			<div class="clear10" ></div>
			<h4 class="list-group-item-heading"><a href="/admin/edit/<?=$row['el_type'];?>/<?=$row['el_id'];?>" ><?=$row['title'];?></a></h4>
		</li>
		
		<?
		}
	}
	mysql_data_seek($updates,0);
	?>
	
	</ul>
	<?
	}
?>