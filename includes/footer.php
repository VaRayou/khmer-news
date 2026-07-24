<footer>
    <p>© 2026 Khmer News Website</p>
</footer>

<script>
const pageSelector = '.container, .content-page, .category-page';
let activeRouteController = null;

function getPageContent(doc) {
    return doc.querySelector(pageSelector);
}

function updatePage(html, url, shouldPushState) {
    const nextDoc = new DOMParser().parseFromString(html, 'text/html');
    const currentContent = getPageContent(document);
    const nextContent = getPageContent(nextDoc);
    const nextNavbar = nextDoc.querySelector('.navbar');
    const nextSearchBar = nextDoc.querySelector('.search-bar');

    if (!currentContent || !nextContent) {
        window.location.href = url;
        return;
    }

    document.title = nextDoc.title;
    nextContent.classList.add('route-enter');
    currentContent.replaceWith(nextContent);

    if (nextNavbar && document.querySelector('.navbar')) {
        document.querySelector('.navbar').replaceWith(nextNavbar);
    }

    if (nextSearchBar && document.querySelector('.search-bar')) {
        document.querySelector('.search-bar').replaceWith(nextSearchBar);
    }

    if (shouldPushState) {
        history.pushState(null, '', url);
    }

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    requestAnimationFrame(function () {
        nextContent.classList.add('route-ready');
    });

    setTimeout(function () {
        nextContent.classList.remove('route-enter', 'route-ready');
    }, 260);
}

function routeLink(url, shouldPushState = true) {
    const currentContent = getPageContent(document);

    if (activeRouteController) {
        activeRouteController.abort();
    }

    activeRouteController = new AbortController();

    if (currentContent) {
        currentContent.classList.add('route-leaving');
    }

    fetch(url, {
        headers: {
            'X-Requested-With': 'fetch'
        },
        signal: activeRouteController.signal
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Page request failed');
            }

            return response.text();
        })
        .then(function (html) {
            updatePage(html, url, shouldPushState);
        })
        .catch(function (error) {
            if (error.name === 'AbortError') {
                return;
            }

            window.location.href = url;
        })
        .finally(function () {
            activeRouteController = null;

            if (currentContent) {
                currentContent.classList.remove('route-leaving');
            }
        });
}

document.addEventListener('click', function (event) {
    const link = event.target.closest('a');

    if (!link) {
        return;
    }

    const url = new URL(link.href, window.location.href);
    const isInternal = url.origin === window.location.origin;
    const isSamePage = url.href === window.location.href;

    if (!isInternal || isSamePage || link.target || link.getAttribute('href') === '#') {
        return;
    }

    event.preventDefault();
    routeLink(url.href);
});

document.addEventListener('submit', function (event) {
    const form = event.target.closest('form.search-bar');

    if (!form) {
        return;
    }

    event.preventDefault();
    const url = new URL(form.action, window.location.href);
    const formData = new FormData(form);

    for (const [key, value] of formData.entries()) {
        url.searchParams.set(key, value);
    }

    routeLink(url.href);
});

window.addEventListener('popstate', function () {
    routeLink(window.location.href, false);
});
</script>

</body>
</html>
