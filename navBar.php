<style>
    @media all and (min-width: 992px) {

        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .dropdown-menu .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu>li:hover>.submenu {
            display: block;
        }
    }

    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {

        .dropdown-menu .dropdown-menu {
            margin-left: 0.7rem;
            margin-right: 0.7rem;
            margin-bottom: .5rem;
        }

    }
</style>



<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3 sticky-top">
    <div class="container" style="">
        <a class="navbar-brand madimi " href="./index.php">OssyBab</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="d-flex align-items-center w-100 form-search">
                <div class="input-group">


                    <button class='btn bg-white shadow-0' href='produit.php'
                        style='padding-bottom: 0.4rem;'><a href='produit.php' class='text-decoration-none text-dark'> All </a> </button>
                    <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu">
                        <?php
                        $sql = "SELECT DISTINCT c.CategoryName, pt.TypeName , c.CategoryID , pt.ProductTypeID
                                    FROM ProductTypes pt
                                    JOIN producttypecategories ptc ON pt.ProductTypeID = ptc.ProductTypeID
                                    JOIN Categories c ON ptc.CategoryID = c.CategoryID  
                                    ORDER BY c.CategoryName ASC, pt.TypeName ASC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $token = uniqid(); // Generate a unique token
                            $_SESSION['token'] = $token;
                            $currentCategory = '';

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['CategoryName'] !== $currentCategory) {
                                    if ($currentCategory !== '') {
                                        // Close the previous category's submenu
                                        echo "</ul></li>";
                                    }
                                    $currentCategory = $row['CategoryName'];

                                    // Start a new category
                                    echo "<li><a class='dropdown-item' href='produit.php?token=" . $token . "&CT_id=" . $row['CategoryID'] . " '>" . htmlspecialchars($currentCategory) . "</a>";
                                    echo "<ul class='submenu dropdown-menu'>";
                                }
                                // List the type under the current category
                                echo "<li><a class='dropdown-item' href='produit.php?token=" . $token . "&PT_id=" . $row['ProductTypeID'] . "&CT_id=" . $row['CategoryID'] . "'>" . htmlspecialchars($row['TypeName']) . "</a></li>";
                            }
                            // Close the last category's submenu
                            if ($currentCategory !== '') {
                                echo "</ul></li>";
                            }
                        }
                        ?>
                    </ul>
                    <input type="search" class="form-control" id="searchInput" placeholder="Search products, brands and categories"
                        aria-label="Search products, brands and catégorie" aria-describedby="button-addon2" />
                </div>
                <a class="text-white p-0" href="#" id="button-addon2"><i class="fas fa-search ps-3"></i></a>
            </form>

            <ul class="navbar-nav ms-3 align-items-center">
                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center me-3 position-relative" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#Id2" aria-controls="Id2">
                        <i class="fa fa-cart-shopping pe-2 "></i>Cart
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger s-2">
                            2
                    </button>
                </li>
                <li class="nav-item" style="width: 100px;;">
                        <a class="btn btn-primary " href="./login/index.php" role="button">Sign in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {


        /////// Prevent closing from click inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        })



        // make it as accordion for smaller screens
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function () {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
            });

            document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
                element.addEventListener('click', function (e) {

                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        console.log(nextEl);
                        if (nextEl.style.display == 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            })
        }

    });

</script>