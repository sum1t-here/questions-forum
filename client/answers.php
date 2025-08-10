<div class="container">
    <h5>Answers:</h5>
    <?php
        $query = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
        $query->bind_param("i", $qid);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<p>" . htmlspecialchars($row["answer"]) . "</p>";
            }
        } else {
            echo "No answer found";
        }
    ?>
</div>