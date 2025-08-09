<div class="container">
    <h1 class="d-flex justify-content-center">
        Ask Questions
    </h1>

    <form class="d-flex flex-column justify-content-center mx-auto" style="max-width: 400px" method="post" action="./server/requests.php">
        <div class="mb-2">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="enter the title"/>
        </div>

        <div class="mb-2">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="enter the description"></textarea>
        </div>

        <div class="mb-2">
            <label for="category" class="form-label">Category</label>
            <?php include("./client/category.php")?>
        </div>

        <button type="submit" class="btn btn-primary" style="max-width: 100px" name="ask">Ask</button>
    </form>
</div>