document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('dashboardSearchForm');
    const input = document.getElementById('dashboardSearchInput');
    const suggestions = document.getElementById('dashboardSearchSuggestions');

    if (!form || !input || !suggestions) return;

    let debounceTimer;
    let requestController;

    const closeSuggestions = function () {
        suggestions.hidden = true;
        input.setAttribute('aria-expanded', 'false');
        input.removeAttribute('aria-activedescendant');
    };

    const renderSuggestions = function (items) {
        suggestions.replaceChildren();

        if (!items.length) {
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'search-suggestions-empty';
            emptyMessage.textContent = 'Tidak ada hasil yang cocok.';
            suggestions.appendChild(emptyMessage);
        } else {
            items.forEach(function (item, index) {
                const link = document.createElement('a');
                link.className = 'search-suggestion';
                link.href = item.url;
                link.id = 'dashboard-search-option-' + index;
                link.setAttribute('role', 'option');
                link.setAttribute('aria-selected', 'false');

                const title = document.createElement('span');
                title.textContent = item.title;
                const type = document.createElement('span');
                type.className = 'search-suggestion-type';
                type.textContent = item.type;

                link.append(title, type);
                suggestions.appendChild(link);
            });
        }

        suggestions.hidden = false;
        input.setAttribute('aria-expanded', 'true');
    };

    const fetchSuggestions = async function (term) {
        requestController = new AbortController();

        const url = new URL(input.dataset.suggestionsUrl, window.location.origin);
        url.searchParams.set('q', term);
        const response = await fetch(url, {
            headers: { 'Accept': 'application/json' },
            signal: requestController.signal
        });

        if (!response.ok) throw new Error('Pencarian gagal dimuat.');
        return response.json();
    };

    input.addEventListener('input', function () {
        window.clearTimeout(debounceTimer);
        if (requestController) requestController.abort();
        closeSuggestions();
        suggestions.replaceChildren();

        const term = input.value.trim();
        if (!term) return;

        debounceTimer = window.setTimeout(async function () {
            try {
                renderSuggestions(await fetchSuggestions(term));
            } catch (error) {
                if (error.name !== 'AbortError') {
                    closeSuggestions();
                    console.error(error);
                }
            }
        }, 180);
    });

    input.addEventListener('keydown', function (event) {
        const options = Array.from(suggestions.querySelectorAll('[role="option"]'));
        const selectedIndex = options.findIndex(function (option) {
            return option.getAttribute('aria-selected') === 'true';
        });

        if (event.key === 'ArrowDown' && options.length) {
            event.preventDefault();
            const nextIndex = (selectedIndex + 1) % options.length;
            options.forEach(function (option, index) {
                option.setAttribute('aria-selected', String(index === nextIndex));
            });
            input.setAttribute('aria-activedescendant', options[nextIndex].id);
        } else if (event.key === 'ArrowUp' && options.length) {
            event.preventDefault();
            const nextIndex = selectedIndex <= 0 ? options.length - 1 : selectedIndex - 1;
            options.forEach(function (option, index) {
                option.setAttribute('aria-selected', String(index === nextIndex));
            });
            input.setAttribute('aria-activedescendant', options[nextIndex].id);
        } else if (event.key === 'Escape') {
            closeSuggestions();
        } else if (event.key === 'Enter' && selectedIndex >= 0) {
            event.preventDefault();
            window.location.assign(options[selectedIndex].href);
        }
    });

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const firstOption = suggestions.querySelector('[role="option"]');
        if (firstOption) {
            window.location.assign(firstOption.href);
            return;
        }

        const term = input.value.trim();
        if (!term) return;

        window.clearTimeout(debounceTimer);
        if (requestController) requestController.abort();

        try {
            const items = await fetchSuggestions(term);
            if (items.length) {
                window.location.assign(items[0].url);
                return;
            }
        } catch (error) {
            if (error.name === 'AbortError') return;
            console.error(error);
        }

        form.submit();
    });

    document.addEventListener('click', function (event) {
        if (!form.contains(event.target)) closeSuggestions();
    });
});
