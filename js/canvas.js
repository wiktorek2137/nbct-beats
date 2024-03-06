let pg;
let font;
let xoff = 0.0;
let tiles = 80; // Wydaje się, że ta zmienna nie jest używana, więc możesz rozważyć jej usunięcie, jeśli nie ma innego zastosowania w kodzie.
let tilesY;
let tilesX = 1;
let tileSizeX;
let tileSizeY;
let loopDuration = 2 * 30; // Ta zmienna również nie jest używana w prezentowanym kodzie.
let unitBaseOnW;

function preload() {
    // Upewnij się, że ścieżka do czcionki jest prawidłowa
    font = loadFont('fonts/Termina.otf');
}

function setup() {
    unitBaseOnW = windowWidth * 0.00535;
    // Ustawienie szerokości canvas na 100% szerokości elementu nadrzędnego
    let parentWidth = document.getElementById('footer-animation').offsetWidth;
    let canvas = createCanvas(parentWidth, unitBaseOnW * 40);
    canvas.parent('footer-animation'); // Umieszcza canvas wewnątrz div#footer-animation
    background(255); // Zmiana tła na białe
    tilesY = 120;
    tileSizeX = width / tilesX;
    tileSizeY = height / tilesY;
    pg = createGraphics(windowWidth, windowHeight);
    pg.textFont(font);
    pg.textAlign(CENTER, CENTER);
    pg.blendMode(SCREEN);
    pg.fill(0);
    // Zaktualizowano pozycję tekstu, aby była relatywna do rozmiaru pg, a nie canvas
    pg.textSize(unitBaseOnW * 51);
    pg.text('NBCT', pg.width / 2, pg.height / 2 - unitBaseOnW * 10);

    frameRate(30);
}

function windowResized() {
    unitBaseOnW = windowWidth * 0.00535;
    // Dostosowanie szerokości canvas do nowej szerokości elementu nadrzędnego
    let parentWidth = document.getElementById('footer-animation').offsetWidth;
    resizeCanvas(parentWidth, unitBaseOnW * 40);
    // Potrzebujesz również zaktualizować pg, aby pasowało do nowego rozmiaru okna
    pg = createGraphics(windowWidth, windowHeight);
    pg.textFont(font);
    pg.textAlign(CENTER, CENTER);
    pg.blendMode(SCREEN);
    pg.fill(0);
    pg.textSize(unitBaseOnW * 51);
    pg.text('NBCT', pg.width / 2, pg.height / 2 - unitBaseOnW * 10);
}

function draw() {
    background(255); // Utrzymaj białe tło również w funkcji draw

    for (let x = 0; x < tilesX; x++) {
        for (let y = 0; y < tilesY; y++) {
            const tileCenterY = y * tileSizeY + tileSizeY / 2;
            const distanceToMouse = abs(mouseY - tileCenterY);
            let waveIntensity = map(distanceToMouse, 0, height / 2, 20, 1, true);
            let waveX = sin(frameCount * x * noise(xoff * 10) + frameCount * y * 0.1) * waveIntensity;
            const sx = x * tileSizeX + waveX;
            const sy = y * tileSizeY;
            const sw = tileSizeX;
            const sh = tileSizeY;
            const dx = x * tileSizeX;
            const dy = y * tileSizeY;
            const dw = tileSizeX;
            const dh = tileSizeY;
            image(pg, dx, dy, dw, dh, sx, sy, sw, sh);
        }
    }
    xoff += 0.01;
}
