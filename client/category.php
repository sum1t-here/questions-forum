<select class="form-control" id="category" name="category">
    <option>Select Category</option>
    <?php
        include("./config/db.php");
        $query="select * from category";
        $res = $conn->query($query);
        foreach($res as $row){
            echo '<option value="' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
        };
    ?>
</select>