<div class="container">
    <h1 class="text-center mb-5">Questions</h1>
    <?php
        include("./config/db.php");

        // Validate $qid before using
        if (!isset($_GET['q-id']) || !is_numeric($_GET['q-id'])) {
            echo '<div class="alert alert-danger">Invalid question ID.</div>';
            exit;
        }
        $qid = (int)$_GET['q-id'];

        try {
            $query = $conn->prepare("SELECT * FROM questions WHERE id = ?");
            if (!$query) {
                throw new Exception("Prepare failed: " . $conn->error);
            }

            if (!$query->bind_param("i", $qid)) {
                throw new Exception("Binding parameters failed: " . $query->error);
            }

            if (!$query->execute()) {
                throw new Exception("Execute failed: " . $query->error);
            }

            $result = $query->get_result();
            if (!$result) {
                throw new Exception("Getting result failed: " . $query->error);
            }

            if ($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold">'
                        . htmlspecialchars($row['title']) .
                    '</h5>
                    <p class="card-text text-muted">'
                        . htmlspecialchars($row['description']) .
                    '</p>
                </div>

                <div class="card-footer bg-light">
                    <form method="post" action="./server/requests.php" class="mt-3">
                        <div class="mb-3">
                            <label for="answer" class="form-label fw-bold">Your Answer:</label>
                            <input type="hidden" name="q_id" value="' . $qid . '"/>
                            <textarea 
                                class="form-control" 
                                id="answer" 
                                name="answer" 
                                rows="4" 
                                placeholder="Write your answer here..."
                            ></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit">Submit Answer</button>
                    </form>
                </div>
            </div>';
            } else {
                echo '<div class="alert alert-warning">No question found for this ID.</div>';
            }

            $query->close();
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Database Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    ?>
</div>
