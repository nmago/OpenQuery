<h1>Лента</h1>

<?php if($interviews): ?>
	<?php foreach($interviews as $iv): ?>
		<div class="question-preview">
			<div class="question-title">
				<a href="interview/show/?id=<?=$iv['id_iv']?>"><?=$iv['ivtext']?></a>
			</div>
			<div class="question-tags">
				<a class="tag" href="#">#ИТ</a>
				<a class="tag" href="#">#ОС</a>
			</div> 
			<div class="question-attached-info">
				<a href="user/show/?id=<?=$iv['id_user']?>"><?=$iv['firstname']?> <?=$iv['lastname']?></a>
				<span class="need_refresh" data="<?= $iv['ivdatetime']?>"></span>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<h2>Нет опросов</h2>
<?php endif; ?>
