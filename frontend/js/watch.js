const searchInput = document.getElementById('searchInput');
const typeFilter = document.getElementById('typeFilter');
const animeCards = document.querySelectorAll('.anime-card');

function applyFilters() {
    const query = searchInput.value.toLowerCase();
    const selectedType = typeFilter.value;

    animeCards.forEach(card => {
        const title = card.getAttribute('data-title');
        const type = card.getAttribute('data-type');

        const matchesTitle = title.includes(query);
        const matchesType = selectedType === "" || type === selectedType;

        card.style.display = matchesTitle && matchesType ? 'block' : 'none';
    });
}

let debounceTimer;
searchInput.addEventListener('input', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        applyFilters();
    }, 1000); // 1 second delay
});

typeFilter.addEventListener('change', applyFilters);
