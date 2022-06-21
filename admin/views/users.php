<?php
include("../controllers/users.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Admin Users</title>
</head>

<body>
    <h1 class="text-center my-3">Users Page</h1>

    <div class="container py-5 my-5 mx-auto border">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">isAdmin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usersSelectStatement = 'SELECT * FROM users';
                    $usersResults = mysqli_query($conn, $usersSelectStatement);
                    while ($userData = mysqli_fetch_array($usersResults)) {
                    ?>
                        <tr>
                            <td><?php echo $userData['id']; ?></td>
                            <td><?php echo $userData['name']; ?></td>
                            <td><?php echo $userData['email']; ?></td>
                            <td><?php echo $userData['phoneNumber']; ?></td>
                            <td><?php echo $userData['isAdmin']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
            </table>

            </tbody>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>