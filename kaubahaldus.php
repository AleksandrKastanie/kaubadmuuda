<?php
  require("abifunktsioonid.php");
$sorttulp="nimetus";
$sorttulp="";
if ()
{

}
  if(isSet($_REQUEST["grupilisamine"])){
    lisaGrupp($_REQUEST["uuegrupinimi"]);
    header("Location: kaubahaldus.php");
    exit();
  }
  if(isSet($_REQUEST["kaubalisamine"])){
    lisaKaup($_REQUEST["nimetus"], $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
    header("Location: kaubahaldus.php");
    exit();
  }
  if(isSet($_REQUEST["kustutusid"])){
     kustutaKaup($_REQUEST["kustutusid"]);
  }
  if(isSet($_REQUEST["muutmine"])){
     muudaKaup($_REQUEST["muudetudid"], $_REQUEST["nimetus"],
                              $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
  }
  $kaubad=kysiKaupadeAndmed();
?>
<!DOCTYPE html>
<html>
  <head>
      <title>Kaupade leht</title>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
      <link rel="stylesheet" type="text/css" href="kaubud.css">
  </head>
  <body>
   <form id= "flopa" action="kaubahaldus.php">
       <table>
           <tr>
               <td>
                   <h2>Grupi lisamine</h2>
               </td>
               <td>
                   <h2>Kauba lisamine</h2>
               </td>
           </tr>
           <tr>
               <td>
                   <dl>
                       <dt>Nimetus:</dt>
                       <dd><input type="text" name="nimetus" /></dd>
                       <dt>Kaubagrupp:</dt>
                       <dd><?php
                           echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid",
                               "kaubagrupi_id");
                           ?>
                       </dd>
                       <dt>Hind:</dt>
                       <dd><input type="text" name="hind" /></dd>
                   </dl>
                   <input type="submit" name="kaubalisamine" value="Lisa kaup" />
               </td>
               <td>
                   <input type="text" name="uuegrupinimi" />
                   <input type="submit" name="grupilisamine" value="Lisa grupp" />
               </td>
           </tr>

     <dl>
 <!--      <dt>Nimetus:</dt>
       <dd><input type="text" name="nimetus" /></dd>
       <dt>Kaubagrupp:</dt>
       <dd><//?php
         echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid", 
                           "kaubagrupi_id");
       ?>
       </dd>
       <dt>Hind:</dt>
       <dd><input type="text" name="hind" /></dd>
     </dl>
     <input type="submit" name="kaubalisamine" value="Lisa kaup" />

     <h2>Grupi lisamine</h2>
     <input type="text" name="uuegrupinimi" />
     <input type="submit" name="grupilisamine" value="Lisa grupp" />
-->
       </table>
   </form>
   <div id ="first">
   <form action="kaubahaldus.php">
     <h2>Kaupade loetelu</h2>
     <table>
       <tr>
         <th>Haldus</th>
           <th><a href = "kaubahaldus.php?sorttulp=nimetus">Nimetus</a></th>
         <th><a href = "kaubahaldus.php?sorttulp=grupinimi">Kaubagrupp</a></th>
         <th><a href = "kaubahaldus.php?sorttulp=hind">Hind</a></th>
       </tr>
       <?php foreach($kaubad as $kaup): ?>
         <tr>
          <?php if(isSet($_REQUEST["muutmisid"]) &&
                            intval($_REQUEST["muutmisid"])==$kaup->id): ?>
           <td>
             <input type="submit" name="muutmine" value="Muuda" />
             <input type="submit" name="katkestus" value="Katkesta" />
             <input type="hidden" name="muudetudid" value="<?=$kaup->id ?>" />
           </td>
           <td><input type="text" name="nimetus" value="<?=$kaup->nimetus ?>" /></td>
           <td><?php
             echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid", 
                                        "kaubagrupi_id", $kaup->kaubagrupi_id);
           ?></td>
           <td><input type="text" name="hind" value="<?=$kaup->hind ?>" /></td>
          <?php else: ?>          
           <td><a href="kaubahaldus.php?kustutusid=<?=$kaup->id ?>"
                  onclick="return confirm('Kas ikka soovid kustutada?')">x</a>
               <a href="kaubahaldus.php?muutmisid=<?=$kaup->id ?>">m</a>
           </td>
           <td><?=$kaup->nimetus ?></td>
           <td><?=$kaup->grupinimi ?></td>
           <td><?=$kaup->hind ?></td>
          <?php endif ?>
         </tr>
       <?php endforeach; ?>
     </table>
   </form>
   </div>
  </body>
</html>
