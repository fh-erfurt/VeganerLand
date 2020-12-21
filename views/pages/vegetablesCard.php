<div class="card">
    <div class="card-title"><?= $row['descrip']?></div>  <!--wird aus datenbank gelesen-->
    <img class='ard__image card__image--fence' src="http://placekitten.com/271/180" class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
    <div class="card__text">
        <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
        <hr>
        <p><?= $row['stdPrice']?></p>                                                                <!--wird aus dem datenbank gelesen-->
    </div>
    <div class="card-footer">
        <button class="btn btn--block card__btn">details</button>
        <button class="btn btn--block card__btn">In den Warenkorb</button>
    </div>
</div>