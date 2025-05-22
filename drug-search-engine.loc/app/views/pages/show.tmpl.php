<?require_once COMPONENTS.'/header.php';?>
        <main class="main py-3">

            <!-- подключение jquery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

            <!-- подключение локального скрипта -->
            <script src="D:\OSPanel\home\drug-search-engine.loc\public\scripts\main.js"></script>

            <div class="container">
                <div class="row mb-3">
                    <?require_once COMPONENTS.'/sidebar.php';?>
                    <div class="col-9">
                        <!-- <h3><?= $medication['name']?></h3> -->
                        <div class="card mb-10" style="max-width : 550px; padding: 15px; opacity: 0.85; margin-left: 50px">
                            <img src="<?=$medication['image']?>" class="card-img-top" style="height: 330px; width: 400px; position: center;" alt="<?= $medication['name']?>">
                            <div class="card-body">
                                <h4 class="card-title" style="margin-left: 50px"><?= $medication['name']?></h4>
                                <p class="card-text info-p" style="margin-left: 100px;">
                                    <b>Страна-производитель:</b>  <?= $medication['country']?><br>
                                    <b>Форма выпуска:</b>  <?= $medication['form']?><br>
                                    <b>Цена:</b>  <?= $medication['price']?>р.<br>
                                    <b>Дозировка:</b>  <?= $medication['value']?><?= $medication['dosage']?><br>
                                    <b>Активные вещества:</b><br>
                                    <ul class="list-group">
                                        <? foreach($activeSubstances as $substance): ?>
                                            <li style="margin-left: 160px"><?= $substance['Name']?></li>
                                        <?endforeach;?>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="error"></div>
                </div>
            </div>

        </main>
<?require_once COMPONENTS.'/footer.php';?>