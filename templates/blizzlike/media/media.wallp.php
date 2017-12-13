<?php
/****************************************************************************/
/*  						< MangosWeb v4 >  								*/
/*              Copyright (C) <2017> <Mistvale.com>   		                */
/*					  < http://www.mistvale.com >							*/
/*																			*/
/*			Original MangosWeb Enhanced (C) 2010-2011 KeysWow				*/
/*			Original MangosWeb (C) 2007, Sasha, Nafe, TGM, Peec				*/
/****************************************************************************/

if(INCLUDED !== TRUE) 
{
	echo "Not Included!"; 
	exit;
}

builddiv_start(1, $lang['wallpaper_gallery']);

if(isset($_GET['act']) && $_GET['act'] == "add")
{
    if($user['id'] <= "0")
    {
    ?>
            <center><div style="background-color:#FF0033;border:groove 4px;margin:4px;padding:6px 9px 6px 9px;"><strong>
    <?php 
            echo $lang['access_denied'];
    }
    else
    {

?>
	
    <center><font color="red"><b><?php echo $lang['Filesize'];?> 4 MB</b></font></center><br/>
    <form method="post" action="?p=media&amp;sub=wallp" enctype="multipart/form-data">
    <?php echo  $lang['file'];?>:<br/>
    <input type="file" name="filename" /><br/>
    <div id="filedgrag">Drag &amp; Drop Files Here</div>
    <center><input type="submit" value="<?php echo $lang['UWallp']; ?>" name="doadd"><br/></center>
    <form>
    
<?php

    }
}
else
{

$gal_count = $DB->count("SELECT `id` FROM `mw_gallery` WHERE `cat`='wallpaper'");

?>

<table border="0" width="100%">

<?php

if($user['id'] >= 1)
{

?>

    <tr>
        <td ><img src="<?= $Template['path']; ?>/images/icons/image_add.gif">&nbsp;<a href="?p=media&amp;sub=wallp&amp;act=add"><?php echo $lang['Addimage'];?></a></td>
        <td align=right><?= $lang['Totalingallery'].":";?> <?= $gal_count; ?></td>
    </tr>
</table>

<?php

}
else
{

?>

    <tr>
        <td align=right><?php echo $lang['Totalingallery'].":";?> <?php echo $gal_count; ?></td>
    </tr>
</table>

<style type = "text/css">
  td.serverStatus1 { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; }
  td.serverStatus2 { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; background-color: #C3AD89; }
  td.rankingHeader { color: #C7C7C7; font-size: 10pt; font-family: arial,helvetica,sans-serif; font-weight: bold; background-color: #2E2D2B; border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px;}
</style>

<?php

}
if($gal_count)
{

?>

<center><b>Page: 1</b></center>
<table border="0">
<tr>

<?php

$sql = $DB->select("SELECT * FROM `mw_gallery` WHERE `cat`='wallpaper'");
foreach($sql as $tablerows)
{

?>

<TR>
<TD ROWSPAN=3 align="center">

<table style="margin: 7px;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td><img src="<?= $Template['path']; ?>/images/gallery/lt.png" class="png" style="width: 9px; height: 9px;" border="0" height="9" width="9"></td>
<td background="<?= $Template['path']; ?>/images/gallery/_t.gif"><img src="<?php echo $Template['path']; ?>/images/gallery/_.gif" height="1" width="1"></td>
<td><img src="<?= $Template['path']; ?>/images/gallery/rt.png" class="png" style="width: 11px; height: 9px;" border="0" height="9" width="11"></td>
</tr>
<tr>
<td background="<?= $Template['path']; ?>/images/gallery/_l.gif"><img src="<?php echo $Template['path']; ?>/images/gallery/_.gif" height="1" width="1"></td>
<td>
<img 
src="modules/ssotd/show_picture.php?filename=<?= $tablerows['img'];?>&amp;gallery=wallp&amp;width=235" border="0"
onclick="javascript:document.getElementById('ssotd_modal_<?= $tablerows['id']; ?>').style.display='block'">
</td>
<td background="<?= $Template['path']; ?>/images/gallery/_r.gif"><img src="<?php echo $Template['path']; ?>/images/gallery/_.gif" height="1" width="1"></td>
</tr>
<tr>
<td><img src="<?= $Template['path']; ?>/images/gallery/lb.png" class="png" style="width: 9px; height: 12px;" border="0" height="12" width="9"></td>
<td background="<?= $Template['path']; ?>/images/gallery/_b.gif"><img src="<?php echo $Template['path']; ?>/images/gallery/_.gif" height="1" width="1"></td>
<td><img src="<?= $Template['path']; ?>/images/gallery/rb.png" class="png" style="width: 11px; height: 12px;" border="0" height="12" width="11"></td>
</tr>
</tbody>
</table>

<div id="ssotd_modal_<?= $tablerows['id']; ?>" class="w3-modal" style="z-index: 100;" onclick="this.style.display='none'">
    <div class="w3-modal-content w3-animate-zoom">
        <img src="modules/ssotd/show_picture.php?filename=<?= $tablerows['img']; ?>&amp;gallery=wallp" style="width:100%">
    </div>
</div>

</TD>
<td><?php echo  $lang['comment'].": ".$tablerows['comment'];?></td>
</TR><TR>
<td><?php echo $lang['author'].": ".$tablerows['autor'];?></td>
</TR><TR>
<td><?php echo $lang['date'].": ".date("Y-m-d", $tablerows['date']);?></td>
</TR>
<TR>
<td colspan=2></td>
</TR>

<?php 
        unset($tablerows); 
    }
    unset($sql);
}
else
{
	echo "No Wallpapers in gallery. Upload a wallpaper.";
}

?>
</tr>
</table>

<?php

builddiv_end();

}

?>