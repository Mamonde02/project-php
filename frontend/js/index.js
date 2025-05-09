function updateClock() {
    const now = new Date();
    const options = {
        timeZone: 'Asia/Manila',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true
    };
    const formatter = new Intl.DateTimeFormat([], options);
    document.getElementById("liveClock").textContent = formatter.format(now);
}

setInterval(updateClock, 1000); // update every second
updateClock(); // run on page load


function toggleAccordion(id) {
    const content = document.getElementById(`content-${id}`);
    const icon = document.getElementById(`icon-${id}`);
    content.classList.toggle('max-h-0');
    content.classList.toggle('max-h-96');
    icon.classList.toggle('rotate-180');
}