<?php
include('../controllers/about.php');
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
    <title>Home</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body class="backColor d-flex flex-column min-vh-100">

    <header class="text-center py-5">
        <div class="container"><img class="img-fluid d-block mx-auto mb-5" src="/ITECA3-Project/assets/quicksilver.png">
        </div>
    </header>

    <section class="mb-0" id="about">
        <div class="container">
            <hr class="star-light my-5">
            <div class="row">
                <div class="col-lg-4 ms-auto">
                    <p class="lead">• Quicksilver Swimming Academy is a 21-year-old company founded in 2001 by Bernie Manzoni. Quicksilver has customers from all age groups ranging from toddlers learning to swim to professional athletes looking to improve their pace in the pool.</p>
                </div>
                <div class="col-lg-4 me-auto">
                    <p class="lead">• Quicksilver currently has about 850 swimmers registered and actively partaking in the training. The company has 17 staff members and is situated at 5 different campuses(schools) where they perform their operations throughout the Western Cape.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="portfolio">
        <div class="container">
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-md-3 col-lg-4"><a class="d-block mx-auto portfolio-item" href="#portfolio-modal-1" data-bs-toggle="modal">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="text-center text-white my-auto portfolio-item-caption-content w-100"><i class="fa fa-search-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="/ITECA3-Project/assets/happy-kids.jpg">
                    </a></div>
                <div class="col-md-6 col-lg-4"><a class="d-block mx-auto portfolio-item" href="#portfolio-modal-1" data-bs-toggle="modal">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="text-center text-white my-auto portfolio-item-caption-content w-100"><i class="fa fa-search-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="/ITECA3-Project/assets/kid-swimming.jpg">
                    </a></div>
                <div class="col-md-6 col-lg-4"><a class="d-block mx-auto portfolio-item" href="#portfolio-modal-1" data-bs-toggle="modal">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="text-center text-white my-auto portfolio-item-caption-content w-100"><i class="fa fa-search-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="/ITECA3-Project/assets/baby-in-pool.jpg">
                    </a></div>
            </div>
        </div>
    </section>


    <?php include('../../include/footer.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


</html>