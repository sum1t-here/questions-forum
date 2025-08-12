<div>
    <h1 class="mb-5">
        Categories
    </h1>
    <?php
        include("./config/db.php");

        $query = "SELECT * FROM category";
        $result = $conn->query($query);

        foreach($result as $row){
            echo '<div class="card shadow-sm mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title mb-0"> 
                            <a href="?cat-id=' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["name"]) . '</a> 
                    </h5>';
            echo '</div>';
            echo '</div>';
        }

    ?>
</div>