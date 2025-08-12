<div class="container">
    <div class="row">
    <div class="col-8">
        <h1 class="text-center mb-5">Questions</h1>
        <?php
            include("./config/db.php");

            if(isset($_GET["cat-id"])){
                $query = $conn->prepare("SELECT * FROM questions WHERE category_id = ?");
                $query->bind_param("i", $cid);
                $query->execute();
                $result = $query->get_result();

                if($result){
                        foreach ($result as $row) {
                            echo '<div class="card shadow-sm mb-3">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title mb-0"> 
                                        <a href="?q-id=' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["title"]) . '</a> 
                                </h5>';
                            echo '</div>';
                            echo '</div>';
                        }   
                }
            } else {
                $query = "SELECT * FROM questions";
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
            }

            
        ?>
    </div>
    <div class="col-4">
        <?php include("./client/categoryList.php") ?>
    </div>
    </div>
</div>