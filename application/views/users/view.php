<?php
	echo '<h2>'.$users_item['usr_nombre'].'</h2>';
	echo $users_item['usr_paterno'];
	echo '<br /><a href="'. base_url() . 'index.php/users/deluser/' . $users_item['usr_uuid'] . '">Eliminar </a>';
