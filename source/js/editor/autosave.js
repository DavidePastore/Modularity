Modularity = Modularity || {};
Modularity.Editor = Modularity.Editor || {};

Modularity.Editor.Autosave = (function ($) {

    function Autosave() {
        $(function(){
            //this.handleEvents();
        }.bind(this));
    }

    Autosave.prototype.save = function (selector) {
        $('#modularity-options #publishing-action .spinner').text(modularityAdminLanguage.isSaving);
        var request = $(selector).serializeObject();
        request.id = modularity_post_id;
        request.action = 'save_modules';

        $.post(ajaxurl, request, function (response) {
            $('#modularity-options #publishing-action .spinner').text('');
        });
    };

    return new Autosave();

})(jQuery);
