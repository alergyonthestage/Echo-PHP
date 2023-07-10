$showMenuButton = document.getElementById('show-menu-button');
$menu = document.getElementById('menu');

$open = false

function expand() {
    $open = !$open;
    if($open) {
        $menu.style.display = "flex";
    } else {
        $menu.style.display = "none";
    }
}