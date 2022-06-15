<?php
include('../session.php');
$_SESSION['activePage'] = 'cart';
include('../userNavbar.php');

$cart = unserialize($_SESSION['cart']);
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <title>Home</title>
</head>

<body>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Shopping cart</p>
                                            <p class="mb-0">You have 4 items in your cart</p>
                                        </div>
                                    </div>

                                    <?php
                                    for ($i = 0; $i < count($cart); $i++) {
                                    ?>
                                        <div class="card mb-3" id="cartItem <?php echo $cart[$i]->id ?>">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div>
                                                            <img src="<?php echo $cart[$i]->imageUrl ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                        </div>
                                                        <div class="ms-3">
                                                            <h5><?php echo $cart[$i]->name ?></h5>
                                                            <p class="small mb-0"><?php echo $cart[$i]->size ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <label for="amount">Qty</label>
                                                        <form method="post" name="updateCartItemQuantityForm" action="cart.php" class="container d-=fle">
                                                            <select name="quantity" id="quantity">
                                                                <option value="1" <?= ($cart[$i]->quantity == '1') ? 'selected' : ''; ?>>1</option>
                                                                <option value="2" <?= ($cart[$i]->quantity == '2') ? 'selected' : ''; ?>>2</option>
                                                                <option value="3" <?= ($cart[$i]->quantity == '3') ? 'selected' : ''; ?>>3</option>
                                                                <option value="4" <?= ($cart[$i]->quantity == '4') ? 'selected' : ''; ?>>4</option>
                                                                <option value="5" <?= ($cart[$i]->quantity == '5') ? 'selected' : ''; ?>>5</option>
                                                                <option value="6" <?= ($cart[$i]->quantity == '6') ? 'selected' : ''; ?>>6</option>
                                                                <option value="7" <?= ($cart[$i]->quantity == '7') ? 'selected' : ''; ?>>7</option>
                                                                <option value="8" <?= ($cart[$i]->quantity == '8') ? 'selected' : ''; ?>>8</option>
                                                                <option value="9" <?= ($cart[$i]->quantity == '9') ? 'selected' : ''; ?>>9</option>
                                                                <option value="10" <?= ($cart[$i]->quantity == '10') ? 'selected' : ''; ?>>10</option>
                                                            </select>
                                                            <input type="hidden" name="id" value="<?php echo $cart[$i]->id ?>">
                                                            <button type='submit' name="updateCartItemQuantity" class='btn btn-primary'>Update</button>
                                                        </form>
                                                        <form method="post" name="deleteCartItemForm" action="cart.php" class="container d-=fle">
                                                            <input type="hidden" name="id" value="<?php echo $cart[$i]->id ?>">
                                                            <button type='submit' name="deleteCartItem" class='btn btn-danger'>
                                                                <i class="bi bi-x-circle"></i>
                                                            </button>
                                                        </form>
                                                        <div style="width: 80px;">
                                                            <h5 class="mb-0">R<?php echo $cart[$i]->price ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>Iphone 11 pro</h5>
                                                        <p class="small mb-0">256GB, Navy Blue</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 50px;">
                                                        <h5 class="fw-normal mb-0">2</h5>
                                                    </div>
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">$900</h5>
                                                    </div>
                                                    <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img2.webp" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>Samsung galaxy Note 10 </h5>
                                                        <p class="small mb-0">256GB, Navy Blue</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 50px;">
                                                        <h5 class="fw-normal mb-0">2</h5>
                                                    </div>
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">$900</h5>
                                                    </div>
                                                    <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img3.webp" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>Canon EOS M50</h5>
                                                        <p class="small mb-0">Onyx Black</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 50px;">
                                                        <h5 class="fw-normal mb-0">1</h5>
                                                    </div>
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">$1199</h5>
                                                    </div>
                                                    <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img4.webp" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>MacBook Pro</h5>
                                                        <p class="small mb-0">1TB, Graphite</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 50px;">
                                                        <h5 class="fw-normal mb-0">1</h5>
                                                    </div>
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">$1799</h5>
                                                    </div>
                                                    <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>