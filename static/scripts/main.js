function Router() {

    this._onClick = function (evt) {

        // make sure we do not intercept ctrl clicks on links
        if (evt.metaKey || evt.ctrlKey || evt.button !== 0) {
            return;
        }

        var node = evt.target;
        do {
            if (node === null || node.nodeName.toLowerCase() === 'a') {
                break;
            }
            node = node.parentNode;
        } while (node);

        if (node && node.classList.contains('internal')) {
            evt.preventDefault();
            this.go(node.href);
        }
    };

    this.go = function (url) {
        if (window.location.href === url) {
            return;
        }

        // Update the current state to have the window.scrollY value.
        window.history.replaceState({
            scrollY: window.scrollY
        }, null, window.location.href);

        // Now redirect to the new URL.
        window.history.pushState(null, null, url);

        return this._onChanged();
    };

    this._loadNewPath  = function () {
        return new Promise(function (resolve, reject) {
            var path = window.location.pathname + window.location.search;
            this._request = new XMLHttpRequest();
            this._request.responseType = 'document';
            this._request.onload = function (evt) {
                this._onLoad(evt);
                resolve();
            }.bind(this);
            this._request.onerror = reject;
            this._request.open('get', path);
            this._request.send();
        }.bind(this));
    };

    this._onLoad  = function (evt) {
        // Bail if this request has been superseded by another, more recent req.
        if (evt.target !== this._request) {
            return;
        }

        this._newContent = evt.target.response;
    };

    this._hideAreas  = function () {
        return new Promise(function (resolve, reject) {
            document.body.classList.add('hide-areas');
            this._mastheadGraphic.addEventListener('transitionend', resolve);
        }.bind(this));
    };

    this._swapContents  = function () {

        var newTitle = this._newContent.querySelector('.master-header h1');
        var newPageContent = this._newContent.querySelector('.page-content');
        var newPageContentHeader = this._newContent.querySelector('.page-content__header');

        for (var i = 0; i < document.body.classList.length; i++) {
            if (document.body.classList[i] == 'hide-areas') continue;

            if (!this._newContent.body.classList.contains(document.body.classList[i])) {
                document.body.classList.remove(document.body.classList[i]);
            }
        }

        for (var i = 0; i < this._newContent.body.classList.length; i++) {
            document.body.classList.add(this._newContent.body.classList[i])
        }

        if (newTitle) {
            this._mastheadTitle.innerHTML = newTitle.innerHTML;
        }

        if (newPageContent) {
            this._pageContent.innerHTML = newPageContent.innerHTML;
        }

        // Double rAF to allow all changes to take hold.
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                document.body.classList.remove('hide-areas');

                // Wait another frame before allowing other requests through.
                requestAnimationFrame(this._onSwapComplete);
            }.bind(this));
        }.bind(this));
    };

    this._onSwapComplete  = function () {
        this._isSwapping = false;
    };

    this._updateNavLinks  = function () {
        var navLinks = document.querySelectorAll('nav a');
        var navHref;
        var navLink;

        for (var i = 0; i < navLinks.length; i++) {
            navLink = navLinks[i];
            navHref = new URL(navLink.href).href;

            // Assume this nav item isn't active.
            navLink.parentNode.classList.remove('active');


            // And if it matches, then yay!
            if (navHref === window.location.href) {
                navLink.parentNode.classList.add('active');
            }
        }
    };

    this._onChanged  = function (evt) {

        this._updateNavLinks();

        // Ignore any changes in the hash.
        if (window.location.pathname === this._location) {
            return;
        }
        this._location = window.location.pathname;

        if (typeof window.ga === 'function') {
            ga('set', 'page', window.location.pathname);
            ga('send', 'pageview');
        }

        // Hide navigation pane
        document.querySelector('#menu__toggle').checked = false;

        Promise.all([
            this._hideAreas(),
            this._loadNewPath()
        ])
        .then(function () {
            if (this._isSwapping) {
                return;
            }
            this._isSwapping = true;

            this._swapContents();
        }.bind(this))
        .then(function() {
            // Restore scroll positioning if needed.
            if (evt && evt.state) {
                window.scrollTo(0, evt.state.scrollY);
            }
        });
    };

    this.addEventListeners  = function () {
        document.addEventListener('click', this._onClick);
        window.addEventListener('popstate', this._onChanged);
    };


    this._location = window.location.pathname;
    this._isSwapping = false;
    this._request = null;
    this._spinnerTimeout = 0;
    this._onChanged = this._onChanged.bind(this);
    this._onLoad = this._onLoad.bind(this);
    this._onClick = this._onClick.bind(this);
    this._onSwapComplete = this._onSwapComplete.bind(this);
    this._newContent = null;

    this._mastheadTitle = document.querySelector('.master-header h1');
    this._mastheadGraphic = document.querySelector('.master-header');
    this._pageContent = document.querySelector('.page-content');


    this.addEventListeners();

    // Check the hash for the notifications.
    this._onChanged();
}

window.onload = function(){
    new Router();
};
