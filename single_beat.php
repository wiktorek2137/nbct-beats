<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBCT SINGLE BEAT</title>
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
    <div class="beat-selector">
        <div class="beat-container-section">
            <!-- LINIE W TLE NIE DOTYKAĆ -->
            <div class="beat-linie-cont-white">
                <div class="beat-linie-white">
                    <div class="beat-linie-el-white"></div>
                    <div class="beat-linie-el-white"></div>
                    <div class="beat-linie-el-white"></div>
                    <div class="beat-linie-el-white"></div>
                </div>
            </div>
            <!-- INFO O BEACIE -->
            <div class="beat-info-el">
                <div class="beat-info-el-img">
                    <div class="beat-info-el-img-btn">
                        <a>POSŁUCHAJ</a>
                        <img src="img/nbct-arrow.svg">
                    </div>
                </div>
                <div class="beat-info-title">
                    <a id="beat-name">TYTUŁ</a>
                </div>
                <div class="beat-info-autor">
                    <a id="beat-autor-name">AUTOR</a>
                </div>
                <div class="beat-info-icons">
                    <img src="img/download.png" class="beat-info-icons-item">
                    <img src="img/fav.png" class="beat-info-icons-item">
                    <img src="img/share.png" class="beat-info-icons-item">
                </div>
            </div>
            <!-- BANDANA -->
            <div class="beat-bandana-section">
                <div class="beat-bandana-el">
                    <div class="beat-bandana-el-text">
                        <span>NBCT BEATS</span>
                        <span>NBCT BEATS</span>
                        <span>NBCT BEATS</span>
                    </div>
                </div>
            </div>
            <!-- ? -->
            <div class="beat-info-details">
                <div class="beat-info-details-title">
                    <a>INFORMACJE</a>
                </div>
                <div class="beat-info-details-desc">
                    <!-- INFORAMCJE -->
                </div>
                <div class="beat-info-details-title">
                    <a>STATYSTYKI</a>
                </div>
                <div class="beat-info-details-desc">
                    <!-- STATYSTYKI -->
                </div>
            </div>
        </div>
        <div class="beat-content-section">
            <div class="beat-content-license">
                <div class="beat-section-info">
                    <div class="beat-section-title">
                        <div>
                            <div class="beat-section-title-text">
                                <a>POPULARNE GATUNKI</a>
                            </div>
                            <div class="beat-section-desc">
                                <a>Każda licencja różni się od siebie <a class ="beat-section-desc-link" href="regulamin.html">*regulamin</a></a>
                            </div>
                        </div>
                        <div class="beat-section-title-buy">
                            <a id="acctualPrice">XXXPLN</a>
                            <div class="beat-section-title-buy-btn" id="buy-btn">
                                <a>DODAJ DO KOSZYKA</a>
                                <img src="img/nbct-arrow.svg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="beat-section-license-content">
                        <!-- pojedyncza licencja -->
                        <div class="beat-section-license-content-choose">
                            <div class="beat-section-license-content-type">
                                <a>MP3</a>
                            </div>
                            <div class="beat-section-license-content-price">
                                <a id="mp3Licence">XXXPLN</a>
                            </div>
                        </div>
                        <!-- pojedyncza licencja -->
                        <div class="beat-section-license-content-choose">
                            <div class="beat-section-license-content-type">
                                <a>WAV</a>
                            </div>
                            <div class="beat-section-license-content-price">
                                <a id="wavLicence">XXXPLN</a>
                            </div>
                        </div>
                        <!-- pojedyncza licencja -->
                        <div class="beat-section-license-content-choose">
                            <div class="beat-section-license-content-type">
                                <a>STEM</a>
                            </div>
                            <div class="beat-section-license-content-price">
                                <a id="stemLicence">XXXPLN</a>
                            </div>
                        </div>
                </div>
            </div>
            <div class="beat-content-futured">
                <div class="futured-section-info">
                    <div class="futured-section-title">
                        <a>WYBRANE DLA CIEBIE</a>
                        <!-- <a id="categories-more">Zobacz wszystkie</a> -->
                    </div>
                    <div class="futured-section-desc">
                        <a>Zobacz podobne beaty</a>
                    </div>
                </div>
                <div class="beat-futured-section-content">
                    <!-- POJEDYNCZY -->
                </div>
            </div>
            <div class="beat-linie-cont">
                <div class="beat-linie">
                    <div class="beat-linie-el"></div>
                    <div class="beat-linie-el"></div>
                    <div class="beat-linie-el"></div>
                    <div class="beat-linie-el"></div>
                    <div class="beat-linie-el"></div>
                    <div class="beat-linie-el"></div>
                </div>
            </div>
        </div>
    </div>
<!-- PLAYER -->
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
    <script src="js/single_beat.js"></script>
</body>
</html>