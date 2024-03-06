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
    <!-- SLIDER -->
    <div class="hero">
        <div class="hero-info">
            <div class="hero-title">
                <a>TRAPOWE BEATY</a>
            </div>
            <div class="hero-desc">
                <a>Zobacz produkcje naszych producentów</a>
            </div>
            <div class="hero-btn-cont">
                <div class="hero-btn-line"></div>
                <div class="hero-btn">
                    <a>SPRAWDŹ</a>
                    <img src="img/nbct-arrow.svg">
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT -->
    <div class="prod-section">
        <!-- LINIE W TLE NIE DOTYKAĆ -->
        <div class="linie-cont-white">
            <div class="linie-white">
                <div class="linie-el-white"></div>
                <div class="linie-el-white"></div>
                <div class="linie-el-white"></div>
                <div class="linie-el-white"></div>
                <div class="linie-el-white"></div>
                <div class="linie-el-white"></div>
                <div class="linie-el-white"></div>
            </div>
        </div>
        <div class="prod-section-info">
            <div class="prod-section-title">
                <a>NASI PRODUCENCI</a>
                <a id="producers-more">Zobacz wszystkich</a>
            </div>
            <div class="prod-section-desc">
                <a>Zobacz produkcje naszych producentów</a>
            </div>
        </div>
        <div class="prod-section-content">
            <!-- OBSZAR NA ZDJĘCIA REALIZATORÓW -->
        </div>
    </div>
    <!-- FUTURED -->
    <div class="futured-section">
        <div class="futured-section-info">
            <div class="futured-section-title">
                <a>POPULARNE GATUNKI</a>
                <a id="categories-more">Zobacz wszystkie</a>
            </div>
            <div class="futured-section-desc">
                <a>Zobacz najczęściej wybierane kategorie beatów</a>
            </div>
        </div>
        <div class="futured-section-content">
            <!-- OBSZAR NA KATEGORIE -->
        </div>
        <!-- BANDANA -->
        <div class="bandana-section">
            <div class="bandana-el">
                <div class="bandana-el-text">
                    <span>SPRAWDŹ NASZE BEATY</span>
                    <span>SPRAWDŹ NASZE BEATY</span>
                </div>
            </div>
        </div>
        <!-- ? -->
        <div class="popular-new-section">
            <div class="popular-col">
            <!-- POPULAR -->
                <div class="popular-new-section-info">
                    <div class="popular-new-section-title">
                        <a>TERAZ NA TOPIE</a>
                    </div>
                    <div class="popular-new-section-desc">
                        <a>Zobacz najpopularniejsze beaty</a>
                    </div>
                </div>
                <div class="popular-new-section-content">
                    <!-- POJEDYNCZY -->
                </div>
            <!-- ? -->
            </div>
            <!-- NEW -->
            <div class="popular-col">
                <!-- POPULAR -->
                    <div class="popular-new-section-info">
                        <div class="popular-new-section-title">
                            <a>NAJNOWSZE</a>
                        </div>
                        <div class="popular-new-section-desc">
                            <a>Zobacz najnowsze produkcje</a>
                        </div>
                    </div>
                    <div class="popular-new-section-content">
                        <!-- POJEDYNCZY -->
                    </div>
                <!-- ? -->
                </div>
        </div>
    </div>
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
    <div class="linie-cont">
        <div class="linie">
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
            <div class="linie-el"></div>
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
    <script src="js/home_page.js"></script>
</body>
</html>