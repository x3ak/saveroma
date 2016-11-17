class Router {
    constructor () {
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
        this._langSwitcher = document.querySelector('.lang-switcher');


        this.addEventListeners();
        // document.body.classList.add('animatable');

        // Check the hash for the notifications.
        this._onChanged();

    }

    _onClick (evt) {
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
    }

    go (url) {
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
    }

    _loadNewPath () {
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
    }

    _onLoad (evt) {
        // Bail if this request has been superseded by another, more recent req.
        if (evt.target !== this._request) {
            return;
        }

        this._newContent = evt.target.response;
    }
    _hideAreas () {
        return new Promise(function (resolve, reject) {
            document.body.classList.add('hide-areas');
            this._mastheadGraphic.addEventListener('transitionend', resolve);
        }.bind(this));
    }

    _swapContents () {



        // var newPageStyles = this._newContent.querySelector('style[id^="styles"]');
        var newTitle = this._newContent.querySelector('.master-header h1');
        var newPageContent = this._newContent.querySelector('.page-content');
        var newLangSwitcher = this._newContent.querySelector('.lang-switcher');

        // if (newPageStyles) {
        //     Take a copy of the page-specific styles if they don't already exist.
            // if (!document.querySelector('#' + newPageStyles.id)) {
            //     document.head.appendChild(newPageStyles.cloneNode(true));
            // }
        // }

        if (newTitle) {
            this._mastheadTitle.innerHTML = newTitle.innerHTML;
        }

        if (newPageContent) {
            this._pageContent.innerHTML = newPageContent.innerHTML;
        }

        if (newLangSwitcher) {
            this._langSwitcher.innerHTML = newLangSwitcher.innerHTML;
        }


        // var newMasthead =
        //     this._newContent.querySelector('.masthead');
        // var newMastheadGraphic =
        //     this._newContent.querySelector('.masthead__graphic');
        // var newMastheadDivider =
        //     this._newContent.querySelector('.masthead-underlay__divider');
        // var newLiveBanner =
        //     this._newContent.querySelector('.header__live-stream');
        // var newPageVideo =
        //     this._newContent.querySelector('.youtube-video-player');
        //
        // this._mastheadGraphic.removeEventListener('transitionend',
        //     this._onTransitionEnd);
        //
        //
        // this._mastheadGraphic.innerHTML =
        //     newMastheadGraphic.innerHTML;
        //
        //
        // // Change over the CSS classes.
        // this._pageContent.className = newPageContent.className;
        // this._masthead.className = newMasthead.className;
        // this._liveBanner.className = newLiveBanner.className;
        //
        // // Uses classList because changing className on SVG is read-only.
        // if (newMastheadDivider.classList.contains('masthead-underlay__divider--invisible')) {
        //     this._mastheadDivider.classList.add(
        //         'masthead-underlay__divider--invisible');
        // } else {
        //     this._mastheadDivider.classList.remove(
        //         'masthead-underlay__divider--invisible');
        // }
        //
        // PushHandler.updateCurrentView();
        // this._updateTimes();

        // Double rAF to allow all changes to take hold.
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                document.body.classList.remove('hide-areas');

                // Wait another frame before allowing other requests through.
                requestAnimationFrame(this._onSwapComplete);
            }.bind(this));
        }.bind(this));
    }

    _onSwapComplete () {
        this._isSwapping = false;
        // LiveSessionInfo.toggle();
        // LiveBanner.toggle();
    }

    _updateNavLinks () {
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
    }

    _onChanged (evt) {

        this._updateNavLinks();

        // Ignore any changes in the hash.
        if (window.location.pathname === this._location) {
            return;
        }
        this._location = window.location.pathname;

        Promise.all([
            this._hideAreas(),
            this._loadNewPath(),
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
    }

    addEventListeners () {
        document.addEventListener('click', this._onClick);
        window.addEventListener('popstate', this._onChanged);
    }
}

window.onload = function(){
    new Router();
};
