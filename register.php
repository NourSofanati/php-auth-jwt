<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration Page</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<body class="container">
    <div class="p-5">
        <div class="card shadow">
            <div class="card-header">
                Sign up
            </div>
            <div class="card-body">
                <form action="/v1/api/signup.php" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email" required>
                        <label for="email">Enter your email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Enter your password" id="password" required>
                        <label for="password">Enter your password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="name" placeholder="Enter your name" id="name" required>
                        <label for="name">Enter your name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="gender" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="birthday" id="birthday" />
                        <label for="birthday">Enter your birthday</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="phonenum" id="phonenum" placeholder="enter your phone number" />
                        <label for="phonenum">Phone number</label>
                    </div>

                    <input class="btn btn-primary mt-3" type="submit" value="Signup">
                    <br>
                    <hr>
                    <p class="text-muted mt-3">Already have an account? <a href="./index.php">Login instead</a></p>
                </form>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>