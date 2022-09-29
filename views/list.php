<center><table class="movies">
    <tr>
        <th>Title</th>
        <th>Year</th>
        <th>Type</th>
        <th>Poster</th>
    </tr>
<?php
foreach($list as $key => $data){
?>
<tr>
    <td><?=$data["Title"]?></td>
    <td><?=$data["Year"]?></td>
    <td><?=$data["Type"]?></td>
    <td><img src="<?=$data["Poster"]?>" height="120px"></td>
</tr>

<?php
    }


?>
</table></center>