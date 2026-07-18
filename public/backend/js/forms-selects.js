$(document).ready(function () {
    var selectPicker = $(".selectpicker");
    var select2Normal = $(".select2");
    var select2Icons = $(".select2-icons");

    function formatWithIcon(state) {
        if (!state.id || !state.element) {
            return state.text;
        }

        var icon = $(state.element).data("icon");
        return icon
            ? "<i class='" + icon + " me-2'></i>" + state.text
            : state.text;
    }

    // Bootstrap Select
    if (selectPicker.length) {
        selectPicker.selectpicker();
    }

    // Normal Select2
    if (select2Normal.length) {
        select2Normal.each(function () {
            var $this = $(this);

            if (!$this.parent().hasClass("position-relative")) {
                $this.wrap('<div class="position-relative"></div>');
            }

            $this.select2({
                placeholder: "Select value",
                dropdownParent: $this.parent(),
            });
        });
    }

    if (select2Icons.length) {
        if (!select2Icons.parent().hasClass("position-relative")) {
            select2Icons.wrap('<div class="position-relative"></div>');
        }

        select2Icons.select2({
            dropdownParent: select2Icons.parent(),
            templateResult: formatWithIcon,
            templateSelection: formatWithIcon,
            escapeMarkup: function (markup) {
                return markup;
            },
        });
    }
});
