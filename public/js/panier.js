(function($){
    $.fn.panier = function() {
        var panier = 
        {
            tab : []
            ,length: function () {
                return this.tab.length;
            }
            ,get: function() {
                return this.tab;
            }
            ,dump : function () {
                console.log(this.tab)
            }
            ,push : function(data) {
                this.tab.push(data)
            }
            ,splice : function(data) {
                this.tab.splice(this.tab.indexOf(data), 1);
            }

        }
        return panier;
    }

})(jQuery);