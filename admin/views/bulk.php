<?php
include('../controllers/bulk.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/ITECA3-Project/include/globalStyles.css" rel="stylesheet" />
    <title>Admin Bulk</title>
</head>

<body class="backColor">
    <h1 class="text-center my-3">Bulk Order Required</h1>

    <div class="container py-5 my-5 mx-auto border">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ProductID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Small</th>
                        <th scope="col">Medium</th>
                        <th scope="col">Large</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($bulkProductsOrder as $productData) {
                    ?>
                        <tr>
                            <td><?php echo $productData->productId; ?></td>
                            <td><?php echo $productData->name; ?></td>
                            <td><?php echo $productData->smallSize; ?></td>
                            <td><?php echo $productData->mediumSize; ?></td>
                            <td><?php echo $productData->largeSize; ?></td>
                            <td><?php echo $productData->total; ?></td>
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