document.querySelectorAll('.global-search-form').forEach(form => {
    const input = form.querySelector('[data-global-search-input]');
    const suggestions = form.querySelector('.global-search-suggestions');
    const { suggestionsUrl } = form.dataset;

    if (!input || !suggestions || !suggestionsUrl) return;

    let debounceTimer;
    let activeIndex = -1;
    let requestController;

    const closeSuggestions = () => {
        suggestions.hidden = true;
        input.setAttribute('aria-expanded', 'false');
        input.removeAttribute('aria-activedescendant');
        activeIndex = -1;
    };

    const setActiveOption = index => {
        const options = [...suggestions.querySelectorAll('[role="option"]')];
        if (!options.length) return;

        activeIndex = (index + options.length) % options.length;
        options.forEach((option, optionIndex) => {
            option.classList.toggle('is-active', optionIndex === activeIndex);
        });
        input.setAttribute('aria-activedescendant', options[activeIndex].id);
        options[activeIndex].scrollIntoView({ block: 'nearest' });
    };

    const showSuggestions = () => {
        suggestions.hidden = false;
        input.setAttribute('aria-expanded', 'true');
    };

    const renderSuggestions = items => {
        suggestions.replaceChildren();

        if (!items.length) {
            const emptyMessage = document.createElement('p');
            emptyMessage.className = 'global-search-empty';
            emptyMessage.textContent = 'Tidak ada saran yang cocok.';
            suggestions.appendChild(emptyMessage);
            showSuggestions();
            return;
        }

        items.forEach((item, index) => {
            const option = document.createElement('a');
            option.className = 'global-search-suggestion';
            option.id = `global-search-option-${index}`;
            option.href = item.url;
            option.setAttribute('role', 'option');
            option.setAttribute('aria-selected', 'false');

            const title = document.createElement('span');
            title.className = 'global-search-suggestion-title';
            title.textContent = item.title;

            const type = document.createElement('span');
            type.className = 'global-search-suggestion-type';
            type.textContent = item.type;

            const description = document.createElement('span');
            description.className = 'global-search-suggestion-description';
            description.textContent = item.description;

            option.append(title, type, description);
            suggestions.appendChild(option);
        });

        showSuggestions();
    };

    input.addEventListener('input', () => {
        window.clearTimeout(debounceTimer);
        requestController?.abort();
        activeIndex = -1;

        const query = input.value.trim();
        if (!query) {
            closeSuggestions();
            return;
        }

        debounceTimer = window.setTimeout(async () => {
            requestController = new AbortController();
            const url = new URL(suggestionsUrl, window.location.origin);
            url.searchParams.set('q', query);

            try {
                const response = await fetch(url, {
                    headers: { 'Accept': 'application/json' },
                    cache: 'no-store',
                    signal: requestController.signal
                });
                if (response.ok) renderSuggestions(await response.json());
            } catch (error) {
                if (error.name !== 'AbortError') closeSuggestions();
            }
        }, 140);
    });

    input.addEventListener('keydown', event => {
        const options = [...suggestions.querySelectorAll('[role="option"]')];

        if (event.key === 'ArrowDown' && options.length) {
            event.preventDefault();
            setActiveOption(activeIndex + 1);
        } else if (event.key === 'ArrowUp' && options.length) {
            event.preventDefault();
            setActiveOption(activeIndex < 0 ? options.length - 1 : activeIndex - 1);
        } else if (event.key === 'Enter' && activeIndex >= 0 && options[activeIndex]) {
            event.preventDefault();
            window.location.assign(options[activeIndex].href);
        } else if (event.key === 'Escape') {
            closeSuggestions();
        }
    });

    document.addEventListener('click', event => {
        if (!form.contains(event.target)) closeSuggestions();
    });
});