(function($){
    $.fn.panier = function() {
        var panier = 
        {

            tab : []
            ,current_value : null
            /**
            *
            */
            ,length: function () {
                return this.tab.length;
            }
            /**
            *
            */
            ,get: function(key=null) {
                if (key != null)
                    return this.tab[key];
                return this.tab;
            }
            /**
            *
            */
            ,dump : function () {
                console.log(this.tab)
            }
            /**
            *
            */
            ,push : function(data) {
                this.current_value = data;
                this.tab.push(data);
            }
            /**
            *
            */
            ,getCurrentValue : function() {
                return this.current_value;
            }
            /**
            *
            */
            ,splice : function(data) {
                this.tab.splice(this.index(data), 1);
            }
            /**
            *
            */
            ,index : function(data) {
                return this.tab.indexOf(data);
            }

        }
        return panier;
    }

})(jQuery);