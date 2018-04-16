const page = window.location.pathname;
console.log(page);
if (page === "/restauration") {
    const activeLink = document.getElementById('cafeteria');
    activeLink.classList.add('active');
} else if (page === "/atelier") {
    const activeLink = document.getElementById('workshop');
    activeLink.classList.add('active');
} else if (page === "/kustoms") {
    const activeLink = document.getElementById('kustoms');
    activeLink.classList.add('active');
} else if (page === "/boutique") {
    const activeLink = document.getElementById('shop');
    activeLink.classList.add('active');
}