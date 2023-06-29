$backButton = document.getElementById('nav-back-button');
$logo = document.getElementById('logo');
$menuButton = document.getElementById('nav-menu-button');
$nav = document.getElementById('nav-items');

$open = false

function expand() {
    $open = !$open;
    if($open) {
        $nav.style.display = "flex";
    } else {
        $nav.style.display = "none";
    }
}