const currentLocation = location.pathname;
const menuItem = document.querySelectorAll('a').forEach(link => {
    if (link.href.includes(`${currentLocation}`)) {
        link.classList.add('active');
    }
})