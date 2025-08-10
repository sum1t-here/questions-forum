<div class="container">
    <h1 class="text-center mb-5">Questions</h1>
    <div class="col-8">
    <?php
        include("./config/db.php");
        $query = "select * from questions";
        $result = $conn->query($query);

        foreach ($result as $row) {
            echo '<div class="card shadow-sm mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title mb-0"> 
                        <a href="?q-id=' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["title"]) . '</a> 
                </h5>';
            echo '</div>';
            echo '</div>';
        };
    ?>
    </div>
</div>