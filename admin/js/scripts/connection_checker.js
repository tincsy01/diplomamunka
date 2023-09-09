function checkInternetConnectionAndRedirect() {
    if (navigator.onLine) {
        console.log("Az internetkapcsolat működik.");
        clearInterval(interval);
        window.location.href = "./users.php";
    } else {
        console.log("Az internetkapcsolat nincs aktív.");
        clearInterval(interval);
        window.location.href = "./inactive.php";
    }
}

// Az ellenőrzést másodpercenként hajtjuk végre.
var interval = setInterval(checkInternetConnectionAndRedirect, 1000);