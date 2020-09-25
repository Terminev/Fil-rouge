const boutonREH = document.querySelector('.boutonREH');

boutonREH.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth",
    })
}