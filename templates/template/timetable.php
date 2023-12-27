<?php foreach ($listTimeTable as $timeTable) { ?>
 <p><?=$timeTable->getTimetableFormated()?></p>
 <?php if($_SERVER['PHP_SELF'] === "/timetableAdmin.php") { ?>
  <button id="<?=$timeTable->getIdDay()?>">Modifier</button>
 <?php } ?> 
<?php } ?>