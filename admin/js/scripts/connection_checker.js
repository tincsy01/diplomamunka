function checkInternetConnectionAndRedirect() {
    if (navigator.onLine) {
        console.log("Az internetkapcsolat működik.");
        clearInterval(interval); // Ha elérhető, leállítjuk az ellenőrzést.
        window.location.href = "./users.php"; // Itt megadhatja a céloldal URL-jét.
    } else {
        console.log("Az internetkapcsolat nincs aktív.");
        clearInterval(interval);
        window.location.href = "./inactive.php"; // Itt megadhatja a céloldal URL-jét.
    }
}

// Az ellenőrzést másodpercenként hajtjuk végre.
var interval = setInterval(checkInternetConnectionAndRedirect, 1000);