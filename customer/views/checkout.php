<?php
include('../controllers/checkout.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="/ITECA3-Project/include/globalStyles.css" rel="stylesheet" />
    <title>Checkout Page</title>
</head>

<body class="backColor">

    <div class="container text-centre">
        <h1 class="text-center my-3">Checkout screen</h1>
        <div class="container py-5">
            <form method="post" name="placeOrderForm" action="" class="container">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark bg-gradient text-white" style="border-radius: 3rem;">
                        <div class="card-body p-5 text-center">
                            <?php
                            //calculate total
                            if ($subTotal != 0) {
                                $total = $subTotal + $fixedOperationsCost;
                            }
                            ?>
                            <h3>Subtotal : R<?php echo $subTotal ?>
                                <h3>Operations Cost : R<?php echo $fixedOperationsCost ?> </h3>
                                <h3>Total : R<?php echo $total ?>
                                    <div class="location-container">
                                        <label for="location">Collection Location :</label>
                                        <select name="location" id="location">
                                            <option value="Durbanville">Durbanville</option>
                                            <option value="Tygervalley">Tygervalley</option>
                                            <option value="Milnerton">Milnerton</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="totalCost" value="<?php echo $total ?>">
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="placeOrder">Confirm Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>