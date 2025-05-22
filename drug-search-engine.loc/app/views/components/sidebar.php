<?
global $db;
?>
<div class="col-3">
    <h4>Аналоги</h4>
    <ul class="list-group">
        <? foreach($analogues as $analog) : ?>
            <li class="list-group-item">
                <a href="medication?medication=<?=$analog['name']?>"><?= $analog['name']?></a>
                <img src="<?=$analog['image']?>"style="height: 40px; width: 50px; margin-left: 20px" alt="<?= $analog['name']?>">
            </li>
        <? endforeach;?>
    </ul>
</div>