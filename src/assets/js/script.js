(() => {

    document.slideout = new Craft.Slideout('loading', {autoShow: false, autoOpen: false});
    console.log(document.slideout)

    // optional hooks
    document.slideout.on('submit', (e) => {
        // Fired when a form inside slideout successfully posts and returns JSON with success
    });
    document.slideout.on('hide', () => {
        // cleanup if needed
    });

    document.querySelectorAll('.openSlideout').forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();
            const id = event.currentTarget.dataset.id !== undefined ? event.currentTarget.dataset.id : '';
            const url = Craft.getCpUrl('guido/edit?id=' + id);

            // Create an empty slideout and then load content via URL (AJAX)
            document.slideout.open()
            console.log(document.slideout)

            showPopUp(url)


        })
    })

    document.getElementById('openSettings')?.addEventListener('click', (el) => {
        const url = Craft.getCpUrl('guido/settings');
        document.slideout.open()
        console.log(document.slideout)

        showPopUp(url)
    });


})();

function showPopUp(url) {
    fetch(url, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
        .then(r => r.text())
        .then(html => {

            document.slideout.$container.html(html);

            document.slideout.updateSizeAndPosition && document.slideout.updateSizeAndPosition();
        })
        .catch(console.error);

    document.slideout.updateSizeAndPosition && document.slideout.updateSizeAndPosition();

    document.slideout.$container.on('click', '.js-close-slideout', () => document.slideout.close());
    let timer = 0;
    document.slideout.$container.on('keyup', '#bodyTextarea', (el) => {
        const html = el.currentTarget.value
        clearInterval(timer);

        timer = setTimeout(function () {

            const url = Craft.getCpUrl('guido/preview');
            const csrfTokenName = Craft.csrfTokenName;
            fetch(url,
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new URLSearchParams({
                        html: html,
                        [csrfTokenName]: Craft.csrfTokenValue
                    })
                }
            ).then(r => r.text())
                .then(html => {

                    document.slideout.$container.find('#bodyPreview').html(html);

                    document.slideout.updateSizeAndPosition && document.slideout.updateSizeAndPosition();
                })
                .catch(console.error);

            document.slideout.updateSizeAndPosition && document.slideout.updateSizeAndPosition();
        }, 500);

    })
}