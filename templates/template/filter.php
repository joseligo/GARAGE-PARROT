<?php


foreach($doubleRanges as $doubleRange) { ?>
  <div id="<?=$doubleRange['name']?>" class="doubleRange">
  <div class="<?=$doubleRange['type']?> barre">
    <div class="<?=$doubleRange['barreMilieu']?> barreMilieu" style="width:100%; left:0%;"></div>
    <div class="<?=$doubleRange['classeT1']?> t1 thumb" style="left:0%"></div>
    <div class="<?=$doubleRange['classeT2']?> t2 thumb" style="left:100%;"></div>
  </div>
  <div class="label">de <span class="labelMin"></span> à <span class="labelMax"></span></div>
  <input type="hidden" name="<?=$doubleRange['name1']?>" value="" class="inputMin" id="<?=$doubleRange['id1']?>" />
  <input type="hidden" name="<?=$doubleRange['name2']?>" value="" class="inputMax" id="<?=$doubleRange['id2']?>"/>
</div>
<?php } ?>

