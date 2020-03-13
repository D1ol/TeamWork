jQuery.fn.extend({
    clearValue: function () {
        return this.each(function () {
             this.value = '';
        });
    }
});