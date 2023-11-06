<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php foreach ($categories as $item):?>
                <li class="promo__item promo__item--<?=($item['sym_code'])?>">
                    <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($item['name'])?></a>
                </li>
            <?php endforeach;?>
        </ul>

    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php foreach ($lots as $item):?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?=htmlspecialchars($item['picture'])?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=htmlspecialchars($item['name'])?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$item['id']?>"><?=htmlspecialchars($item['name_lot'])?></a></h3>
                        <div class="lot__state">
                            
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=htmlspecialchars(formNum($item['start_price']))?></span>
                            </div>
                            
                            <?php $date_end = get_dt_range($item['date_end'])?>  
                            
                            <div class="lot__timer timer <?php if((int)$date_end[0] <= 24):?> timer--finishing <?php endif; ?>">
                                <?= "$date_end[0]:$date_end[1]"?>
                            </div>
                            
                        </div>
                    </div>
                </li>
            <?php endforeach;?>
        </ul>
    </section>
    </main>