<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBCT BEATS</title>
    <link rel="icon" href="img/nbct-star.svg" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="nav">
        <div class="nav-selector">
            <div class="nav-cont">
                <div class="nav-logo">
                    <img src="img/logo.svg">
                </div>
                <div class="nav-social">
                    <div class="nav-links">
                        <a class="nav-links-underline" id="nav1">PRODUCENCI</a>
                        <a class="nav-links-underline" id="nav2">KATEGORIE</a>
                        <a class="nav-links-underline" id="nav3">NAJNOWSZE</a>
                    </div>
                    <!-- <div class="nav-menu">
                        <a>MENU</a>
                        <div class="nav-burger">
                            <div class="burger-layer"></div>
                            <div class="burger-layer"></div>
                        </div>
                    </div> -->
                    <div class="nav-cart">
                        <img class="nav-cart-icon" src="img/cart.svg" alt="">
                        <div class="nav-cart-count">
                            <a>0</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-bottom">
            <div class="nav-bottom-links">
                <a class="bottom-link">HIP-HOP</a>
                <a class="bottom-link">POP</a>
                <a class="bottom-link">SOUL</a>
                <a class="bottom-link">HOUSE</a>
                <a class="bottom-link">DRILL</a>
            </div>
            <div class="nav-bottom-search">
                <div class="nav-login">
                    <?php
                        if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
                            if($_SESSION['type']=="admin"){
                                echo '<a href="admin-panel.php">Twoje konto</a>';
                            }
                            else{
                                echo '<a href="user-panel.php">Twoje konto</a>';
                            }
                        }
                        else{
                            echo '
                            <a id="register">Zarejestruj się</a>
                                &nbsp;/&nbsp;
                            <a id="login">Zaloguj się</a>
                            ';
                        }
                    ?>
                    </div>
                <div class="nav-login-icon">
                    <img src="img/user.svg">
                </div>
                <form>
                    <div class="nav-search">
                        <button class="nav-search-button"><img src="img/loop.svg"></button>
                        <input type="search" class="nav-search-input" placeholder="CHCESZ COŚ ZNALEŹĆ?">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FUTURED -->
    <div class="checkout-section">
        <div class="futured-section-info">
            <div class="futured-section-title">
                <a>KOSZYK</a>
            </div>
            <div class="futured-section-desc">
                <a>Zobacz podsumowanie swojego zamówienia</a>
            </div>
        </div>
        <div class="checkout-section-content">
            <div class="checkout-section-content-list">
                <!-- SINGLE -->
            </div>
            <div class="checkout-section-content-panel-col">
                <div class="checkout-section-content-panel">
                    <div>
                        <div class="checkout-section-content-panel-info">
                            <div class="checkout-section-content-panel-title">
                                <a>PODSUMOWANIE</a>
                            </div>
                            <div class="checkout-section-content-panel-desc">
                                <a>Szczegóły zamówienia</a>
                            </div>
                        </div>
                        <!-- LISTA -->
                        <div class="checkout-section-content-panel-list">
                            <!--  SINGLE  -->
                        </div>
                    </div>
                    <div>
                        <div class="checkout-section-content-panel-error"></div>
                        <div class="checkout-section-content-panel-voucher">
                            <div class="checkout-section-content-panel-voucher-search">
                                <input id="voucher-code" type="search" class="nav-search-input" placeholder="WPISZ KOD VOUCHERA">
                            </div>
                            <div class="checkout-section-content-panel-voucher-title">
                                <a>DODAJ VOUCHER</a>
                            </div>
                        </div>
                        <!--  -->
                        <div class="checkout-section-content-panel-diver"></div>
                        <!--  -->
                        <div class="checkout-section-content-panel-price">
                            <a>Cena: </a>
                            <a id="cart-price">XXXPLN</a>
                        </div>
                        <div class="checkout-section-content-panel-price-info">
                            <?php
                            if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
                                echo '<a>Kupujesz za pomocą swojego konta</a>';
                            }
                            else{
                                echo '
                                    <p>Kontynuuj jako gość albo <a href="register_page.php">Zarejestruj się</a> lub <a href="login_page.php">Zaloguj</a></p>
                                ';
                            }
                        ?>
                        </div>
                    </div>
                    </div>
                    <div class="checkout-panel-buy">
                        <div class="checkout-panel-buy-cont">
                            <div class="checkout-panel-buy-price">
                                <a id="final-price">XXXPLN</a>
                            </div>
                            <div class="checkout-panel-buy-btn">
                                <a>KUPUJĘ I PŁACĘ</a>
                                <img src="img/nbct-arrow.svg" alt="">
                            </div>
                        </div>
                        <div class="checkout-panel-desc">
                            <a>KUPUJĄC OŚWIADCZAM, ŻE AKCEPTUJĘ</a>&nbsp;<a href="regulamin.php">REGULAMIN*</a>
                        </div>
                    </div>
            </div>
        </div>
        <!-- BANDANA -->
        <!-- <div class="bandana-section">
            <div class="bandana-el">
                <div class="bandana-el-text">
                    <span>SPRAWDŹ NASZE BEATY</span>
                    <span>SPRAWDŹ NASZE BEATY</span>
                </div>
            </div>
        </div> -->
        <!-- ? -->
        </div>
    </div>
    <!-- LINIE W TLE NIE DOTYKAĆ -->
    <div class="linie-cont-checkout">
        <div class="linie-checkout">
            <div class="linie-el-checkout"></div>
            <div class="linie-el-checkout"></div>
            <div class="linie-el-checkout"></div>
            <div class="linie-el-checkout"></div>
            <div class="linie-el-checkout"></div>
            <div class="linie-el-checkout"></div>
            <div class="linie-el-checkout"></div>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-links">
            <div class="footer-nav">
                <div class="footer-col">
                    <div class="footer-col-title">
                        <h2>NA SKRÓTY</h2>
                    </div>
                    <div class="footer-col-section">
                        <div class="footer-col-a">
                            <div>O NAS</div>
                            <div>OFERTA</div>
                            <div>LOKALIZACJE</div>
                            <div>WYCEŃ SWÓJ MIX</div>
                            <div>POLITYKA PRYWATNOŚCI</div>
                        </div>
                        <div class="footer-col-a">
                            <div>ARTYŚCI</div>
                            <div>KONTAKT</div>
                            <div>SPRZĘT</div>
                            <div>ZAREZERWUJ STUDIO</div>
                            <div>REGULAMIN SKLEPU</div>
                        </div>
                    </div>
                </div>
                <div class="footer-col">
                    <div class="footer-col-title">
                        <h2>SOCIAL MEDIA</h2>
                    </div>
                    <div class="footer-col-section">
                        <div class="footer-col-a">
                            <div>INSTAGRAM</div>
                            <div>TIKTOK</div>
                            <div>DISCORD</div>
                        </div>
                        <div class="footer-col-a">
                            <div>FACEBOOK</div>
                            <div>YOUTUBE</div>
                            <div>GRUPA</div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="img/nbct-star.svg">
        </div>
        <div class="footer-animation" id="footer-animation">
            tu powinna być animacja
        </div>
        <div class="footer-credits">
            <a>COPYRIGHT © 2024 NOBOCOTO.PL</a>
            <a>Więcej niż studio nagrań</a>
            <a>PROJEKT: WPROJECTS.PL</a>
        </div>
    </div>
    <script src="js/nav.js"></script>
    <script src="js/checkout.js"></script>
</body>
</html>