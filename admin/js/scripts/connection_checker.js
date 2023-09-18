function checkInternetConnectionAndRedirect() {
    if (navigator.onLine) {
        console.log("Az internetkapcsolat működik.");
        clearInterval(interval);
    } else {
        console.log("Az internetkapcsolat nincs aktív.");
        clearInterval(interval);
        window.location.href = "./inactive.php";
    }
}
var interval = setInterval(checkInternetConnectionAndRedirect, 1000);