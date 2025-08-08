<div class="container">
    <h1 class="d-flex justify-content-center">
        Signup
    </h1>

    <form class="d-flex flex-column justify-content-center mx-auto" style="max-width: 400px" method="post" action="./server/requests.php">
        <div class="mb-2">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="enter your username"/>
        </div>

        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="enter your email"/>
        </div>

        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="enter your password"/>
        </div>

        <div class="mb-2">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="enter your address"/>
        </div>

        <button type="submit" class="btn btn-primary" style="max-width: 100px" name="signup">Sign up</button>
    </form>
</div>