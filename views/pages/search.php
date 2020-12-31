<div class="block-container">
    <ul class="cards">
        <? $counter = 0;

            if (empty($search)) {
                echo "<div class='alert alert-danger'>Es konnte nichts gefunden werden.</div>";
            } else {
                while($counter < count($search)):
                    if ($search[$counter]['cat'] === 'V' || $search[$counter]['cat'] === 'P' || $search[$counter]['cat'] === 'M') {
                    $name = VEGETABLEPATH;
                } else {
                    $name = FRUITPATH;
                }?>
                    <li class="cards__item"> 
                        <div class="col">
                            <div class="card">
                                <div class="card-title"><?=$search[$counter]['descrip']?></div>
                                <img class='ard__image card__image--fence' src="<?=$name.$search[$counter]['descrip']?>.jpg" class="card-img-top" alt="Artikel">
                                <div class="card__text">
                                    <p>test product, hier eine tolle lange beschreibung</p>
                                    <hr>
                                    <p><?=$search[$counter]['stdPrice']?></p>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn--block card__btn">details</button>
                                    <button class="btn btn--block card__btn">In den Warenkorb</button>
                                </div>
                            </div>
                        </div>
                    </li>
                <?  $counter++;
                endwhile;
            }?>
    </ul>
</div>
