<?php
session_start();
if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header('Location: login_page.php');
    exit;
}
// Dodatkowo sprawdź, czy użytkownik to admin
if ($_SESSION['type'] !== 'admin') {
    // Przekieruj do strony logowania lub strony błędu
    header('Location: login_page.php');
    exit;
}
$prodId = isset($_SESSION['prod_id']) ? $_SESSION['prod_id'] : '0';
$userid = $_SESSION['id'];
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
                <a>PANEL PRODUCENTA</a>
            </div>
            <div class="futured-section-desc">
                <a>Zarządzaj swoimi produkcjami</a>
            </div>
        </div>
        <div class="panel-section">
            <div class="panel-menu">
                <div class="panel-menu-item">
                    <img src="img/panel.png" alt="" class="panel-menu-item-img">
                    <a>PANEL</a>
                </div>
                <div class="panel-menu-item">
                    <img src="img/tresci.png" alt="" class="panel-menu-item-img">
                    <a>TREŚCI</a>
                </div>
                <div class="panel-menu-item">
                    <img src="img/stats.png" alt="" class="panel-menu-item-img">
                    <a>STATYSTYKI</a>
                </div>
                <div class="panel-menu-item">
                    <img src="img/user.png" alt="" class="panel-menu-item-img">
                    <a>TWÓJ PROFIL</a>
                </div>
                <div class="panel-menu-item">
                    <img src="img/settings.png" alt="" class="panel-menu-item-img">
                    <a>USTAWIENIA</a>
                </div>
                <div class="panel-menu-item" id="logoutBtn">
                    <img src="img/logout.png" alt="" class="panel-menu-item-img">
                    <a>WYLOGUJ SIĘ</a>
                </div>
            </div>
            <div class="panel-content">
                <div class="panel-choose">
                    <div class="panel-choose-post" id="slide1">

                        <div class="panel-choose-post-title">
                            <a>PANEL</a>
                        </div>
                        <div class="panel-choose-post-content">
                            <div class="panel-choose-post-content-el">
                                <div class="panel-choose-post-content-el-img"></div>
                                <div class="panel-choose-post-content-el-info">
                                    <p>NAJNOWSZY BEAT</p>
                                    <a>XXX SŁUCHACZY</a>
                                    <a>XXX ODDTWORZEŃ</a>
                                    <a>XXX POLUBIEŃ</a>
                                    <a>XXX PLN</a>
                                </div>
                                <div class="panel-choose-post-content-el-stats">
                                    <p>OSTATNIE 7 DNI</p>
                                    <a>XXX SŁUCHACZY</a>
                                    <a>XXX ODDTWORZEŃ</a>
                                    <a>XXX POLUBIEŃ</a>
                                    <a>XXX PLN</a>
                                </div>

                            </div>
                            <form action="php/beatAdd.php" method="post" enctype="multipart/form-data">
                            <div class="panel-choose-post-content-el-form">
                                <div class="panel-form-headliner">
                                    <a>DODAJ NOWY BEAT</a>
                                </div>
                                <div class="panel-form-content">
                                    <div class="panel-form-item">
                                        <a>OKŁADKA</a>
                                        <input type="file" name="beat_cover">
                                    </div>
                                    <div class="panel-form-item">
                                        <a>PLIK MP3</a>
                                        <input type="file" name="beat_music">
                                    </div>
                                    <div class="panel-form-item">
                                        <a>TYTUŁ</a>
                                        <input type="text" name="beat_title" placeholder="Tytuł twojego beatu">
                                    </div>
                                    <div class="panel-form-item">
                                        <a>CENA ZA MP3</a>
                                        <input type="text" name="beat_price" placeholder="Cena minimalna">
                                    </div>
                                    <div class="panel-form-item">
                                        <a>KEY</a>
                                        <select name="beat_key" id="key-id">
                                            <option value="">WYBIERZ OPCJĘ</option>
                                            <option value="C Minor">C Minor</option>
                                            <option value="C# Minor">C# Minor</option>
                                            <option value="D Minor">D Minor</option>
                                            <!-- Dodaj pozostałe opcje według potrzeb -->
                                        </select>
                                    </div>
                                    <div class="panel-form-item">
                                        <a>BPM</a>
                                        <input type="number" name="beat_bpm" placeholder="Wpisz bpm" max="500">
                                    </div>
                                    <div class="panel-form-item">
                                        <a>KATEGORIA</a>
                                        <select name="beat_cat" id="cat-id">
                                            <option value="">WYBIERZ OPCJĘ</option>
                                            <option value="HIP-HOP">HIP-HOP</option>
                                            <option value="POP">POP</option>
                                            <option value="HOUSE">HOUSE</option>
                                            <option value="DRILL">DRILL</option>
                                            <!-- Dodaj pozostałe kategorie według potrzeb -->
                                        </select>
                                    </div>
                                    <div class="panel-form-btn">
                                        <button type="submit">DODAJ BEAT</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        </div>

                    </div>
                    <div class="panel-choose-post" id="slide2" style="display: none;">

                        <div class="panel-choose-post-title">
                            <a>TWOJE TREŚCI</a>
                        </div>
                        <div class="panel-choose-post-content-headliner">
                                    <div class="panel-choose-post-content-tresci-info">
                                        <div class="panel-choose-post-content-tresci-details panel-choose-post-content-column">
                                            <div class="panel-choose-post-content-tresci-views">
                                                <a>PRODUKCJE</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-choose-post-content-tresci-views panel-choose-post-content-column">
                                        <a>WYŚWIETLENIA</a>
                                    </div>
                                    <div class="panel-choose-post-content-tresci-like panel-choose-post-content-column">
                                        <a>POLUBIENIA</a>

                                    </div>
                                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                                        <a>ZAROBEK</a>

                                    </div>
                                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                                        <!-- <a>DZIAŁANIA</a> -->

                                    </div>
                            </div>
                        <div class="panel-choose-post-content">
                            <!-- TREŚCI -->
                            <div class="panel-choose-post-content-tresci">
                                <!--  -->
                                <div class="panel-choose-post-content-tresci-el">
                                    <div class="panel-choose-post-content-tresci-info panel-choose-post-content-column">
                                        <div class="panel-choose-post-content-tresci-img">
                                        </div>
                                        <div class="panel-choose-post-content-tresci-details">
                                            <div class="panel-choose-post-content-tresci-info-title">
                                                <a>tytul</a>
                                            </div>
                                            <div class="panel-choose-post-content-tresci-info-desc">
                                                <a>120BPM</a>
                                                <a>C#m</a>
                                                <a>TRAP</a>
                                                <a>400PLN</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="icons-on-hover">
                                            <img src="img/star-white.png" class="panel-choose-post-content-icon">
                                            <img src="img/star-white.png" class="panel-choose-post-content-icon">
                                            <img src="img/star-white.png" class="panel-choose-post-content-icon">
                                    </div> -->
                                    <div class="panel-choose-post-content-tresci-views panel-choose-post-content-column">
                                        <a>10 000</a>
                                        <img src="img/eye-white.png" alt="Ilość wyświetleń" class="panel-choose-post-content-icon">
                                    </div>
                                    <div class="panel-choose-post-content-tresci-like panel-choose-post-content-column">
                                        <a>500</a>
                                        <img src="img/star-white.png" alt="Ilość polubień" class="panel-choose-post-content-icon">
                                    </div>
                                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                                        <a>12 320PLN</a>
                                        <img src="img/money-white.png" alt="Twój zarobek" class="panel-choose-post-content-icon">
                                    </div>
                                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                                        <a>EDYTUJ</a>
                                        <a>&nbsp;/&nbsp;</a>
                                        <a>USUŃ</a>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="panel-choose-post-content-tresci-el">
                                    <div class="panel-choose-post-content-tresci-info panel-choose-post-content-column">
                                        <div class="panel-choose-post-content-tresci-img">
                                        </div>
                                        <div class="panel-choose-post-content-tresci-details">
                                            <div class="panel-choose-post-content-tresci-info-title">
                                                <a>tytul</a>
                                            </div>
                                            <div class="panel-choose-post-content-tresci-info-desc">
                                                <a>120BPM</a>
                                                <a>C#m</a>
                                                <a>TRAP</a>
                                                <a>400PLN</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="icons-on-hover">
                                            <img src="img/star-white.png" class="panel-choose-post-content-icon">
                                            <img src="img/star-white.png" class="panel-choose-post-content-icon">
                                            <img src="img/star-white.png" class="panel-choose-post-content-icon">
                                    </div> -->
                                    <div class="panel-choose-post-content-tresci-views panel-choose-post-content-column">
                                        <a>10 000</a>
                                        <img src="img/eye-white.png" alt="Ilość wyświetleń" class="panel-choose-post-content-icon">
                                    </div>
                                    <div class="panel-choose-post-content-tresci-like panel-choose-post-content-column">
                                        <a>500</a>
                                        <img src="img/star-white.png" alt="Ilość polubień" class="panel-choose-post-content-icon">
                                    </div>
                                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                                        <a>12 320PLN</a>
                                        <img src="img/money-white.png" alt="Twój zarobek" class="panel-choose-post-content-icon">
                                    </div>
                                    <div class="panel-choose-post-content-tresci-sell panel-choose-post-content-column">
                                        <a>EDYTUJ</a>
                                        <a>&nbsp;/&nbsp;</a>
                                        <a>USUŃ</a>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <div class="panel-choose-post" id="slide3" style="display: none;">

                        <div class="panel-choose-post-title">
                            <a>STATYSTYKI</a>
                        </div>
                        <div class="panel-choose-post-content">
                            <!-- STATYSTYKI -->


                        </div>

                    </div>
                    <div class="panel-choose-post" id="slide4" style="display: none;">

                        <div class="panel-choose-post-title">
                            <a>TWÓJ PROFIL</a>
                        </div>
                        <div class="panel-choose-post-content">
                            <!-- TWÓJ PROFIL -->
                        </div>

                    </div>
                    <div class="panel-choose-post" id="slide5" style="display: none;">

                        <div class="panel-choose-post-title">
                            <a>USTAWIENIA</a>
                        </div>
                        <div class="panel-choose-post-content">
                            <!-- USTAWIENIA -->


                        </div>

                    </div>
                </div>
            </div>
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
    <script src="js/admin-panel.js"></script>
</body>
</html>