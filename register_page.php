<?php
session_start();
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
    if($_SESSION['type']=="admin"){
        header('Location: admin-panel.php');
    }
    else{
        header('Location: user-panel.php');
    }
    exit();
}
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
    <!-- CONTENT -->
    <div class="prod-section-prods">
        <!-- LINIE W TLE NIE DOTYKAĆ -->
        <div class="linie-cont-white">
            <div class="linie-white">
                <div class="linie-el-prods"></div>
                <div class="linie-el-prods"></div>
                <div class="linie-el-prods"></div>
                <div class="linie-el-prods"></div>
                <div class="linie-el-prods"></div>
                <div class="linie-el-prods"></div>
                <div class="linie-el-prods"></div>
            </div>
        </div>
        <div class="futured-section-info">
            <div class="futured-section-title">
                <a>ZAREJESTRUJ SIĘ</a>
            </div>
            <div class="futured-section-desc">
                <a>Jeśli masz już konto</a>
                <a href="login_page.php">zaloguj się</a>
            </div>
        </div>
        <div class="login-section-content">
            <!-- FORM -->
            <form action="php/registerAdd.php" method="POST" class="login-form">
                <div class="login-section">
                    <div class="login-item">
                        <a>EMAIL:</a>
                        <input name="email" class="login-input" type="email" placeholder="Wpisz swój email">
                    </div>
                    <div class="login-item">
                        <div class="login-item-title">
                            <a>HASŁO:</a>
                        </div>
                        <input name="password" class="login-input" type="password" placeholder="Wpisz swoje hasło">
                    </div>
                    <div class="login-item">
                        <div class="login-item-title">
                            <a>POWTÓRZ HASŁO:</a>
                        </div>
                        <input name="repassword" class="login-input" type="password" placeholder="Wpisz swoje hasło">
                    </div>
                    <button class="login-section-button">
                        <div id="login-btn" class="login-btn">
                            <a>ZAREJESTRUJ SIĘ</a>
                            <img src="img/nbct-arrow.svg" alt="">
                        </div>
                    </button>
                    <div class="login-item-terms">
                        <input type="checkbox" require>
                        <a>Akceptuję Regulamin i Politykę Prywatności sklepu.</a>
                    </div>
                    <?php
                        if (isset($_SESSION['error'])) {
                            // echo '<div class="login-diver"></div>';
                            echo '<div class="form-error"><a>' . $_SESSION['error'] . '</a></div>'; // Wyświetlenie błędu
                            unset($_SESSION['error']); // Usunięcie błędu z sesji, aby nie pojawiał się ponownie
                        }
                    ?>
                    <!-- <div class="login-diver"></div> -->
                </div>
            </form>
            <!--  -->
        </div>
        <!-- BANDANA -->
        <!-- <div class="bandana-section bandana-section-prod">
            <div class="bandana-el">
                <div class="bandana-el-text">
                    <span>SPRAWDŹ NASZE BEATY</span>
                    <span>SPRAWDŹ NASZE BEATY</span>
                </div>
            </div>
        </div> -->
        <!-- ? -->
    </div>

    <!-- FUTURED -->
    <div class="player-section" id="player">
        <div class="player-info">
            <div class="player-img">
                <img src="img/covers/baba.png" id="player-img">
            </div>
            <div class="player-details">
                <div class="player-title" id="player-title">TYTUŁ KAWAŁKA</div>
                <div class="player-autor" id="player-autor">AUTOR</div>
                <div class="player-key" id="player-bpm">C-MINOR/120BPM</div>
            </div>
        </div>
        <div class="player-controls">
            <div class="player-buttons">
                <img src="img/nbct-arrow.svg" class="left-arrow" id="prevTrackButton">
                <div onclick="onStop()"><img src="img/stop.svg" id="playicon"></div>
                <img src="img/nbct-arrow.svg" class="right-arrow" id="nextTrackButton">
            </div>
            <div class="player-timeline">
                <div class="start-time" id="currentclock"></div>
                <input type="range" id="timeline" min="0" max="100" step="1">
                <div class="end-time" id="endclock"></div>
            </div>
        </div>
        <div class="player-volume">
            <img src="img/volume-max.svg" id="volumeicon" class="volume-icon">
            <input type="range" id="volume" min="0" max="1" step="0.01">
        </div>
    </div>
    <!-- LINIE W TLE NIE DOTYKAĆ -->
    <!-- <div class="linie-cont">
        <div class="linie">
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
        </div>
    </div> -->
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
    <script src="js/login.js"></script>
</body>
</html>