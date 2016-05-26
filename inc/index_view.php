
	<h3> Sessions à ESCH-BELVAL</h3>
		<ul>
		<?php foreach ($sessionList as $key=>$value) :?> 
			<li><a href="list.php?ses_id=<?= $value['ses_id'] ?>" > Du <?= $value['ses_opening'] ?> au <?= $value['ses_ending'] ?></a></li>
		<?php endforeach; ?>
		</ul>
	