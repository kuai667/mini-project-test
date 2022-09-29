<center>

    <form method="GET" class="filters">
        <table>
            <tr>
                <td>
                <label for="search">Search by title</label>
                </td>
                <td>
                <label>Date range</label>
                </td>
                <td>
                    <label for="sort">
                        Sort by
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="search" value="<?=$search?>" placeholder="Search">
                </td>
                <td>
                    <input type="number" maxlength="4" minlength="4" placeholder="YYYY" name="lowestYear" value="<?=$lowestYear?>">
                    <input type="number" maxlength="4" minlength="4" placeholder="YYYY" name="highestYear" value="<?=$highestYear?>">
                </td>
                <td>
                    <select name="sort">
                        <option value="asc">asc</option>
                        <?php
                        if(!empty($_GET['sort']) && $_GET['sort'] == "desc"){
                        ?>
                        <option value="desc" selected>desc</option>
                        <?php
                        }else{
                            ?>
                        <option value="desc">desc</option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4"><input type="submit" name="filter" value="Submit"></td>
            </tr>
        </table>
        
    </form>
</center>