
(function( $ ) {
    $.Shop = function( element ) {
        this.$element = $( element ); // top-level element
        this.init();
    };

    $.Shop.prototype = {
        init: function() {
            // initializes properties and methods
        }
    };

    $(function() {
        var shop = new $.Shop( "#site" ); // object's instance
    });

})( jQuery );


$(function() {
    var shop = new $.Shop( "#site" );
    console.log( shop.$element );
});


$.Shop.prototype = {
    init: function() {
        // Properties

            this.cartPrefix = "winery-"; // prefix string to be prepended to the cart's name in session storage
            this.cartName = this.cartPrefix + "cart"; // cart's name in session storage
            this.shippingRates = this.cartPrefix + "shipping-rates"; // shipping rates key in session storage
            this.total = this.cartPrefix + "total"; // total key in the session storage
            this.storage = sessionStorage; // shortcut to sessionStorage object

            this.$formAddToCart = this.$element.find( "form.add-to-cart" ); // forms for adding items to the cart
            this.$formCart = this.$element.find( "#shopping-cart" ); // Shopping cart form
            this.$checkoutCart = this.$element.find( "#checkout-cart" ); // checkout form cart
            this.$checkoutOrderForm = this.$element.find( "#checkout-order-form" ); // checkout user details form
            this.$shipping = this.$element.find( "#sshipping" ); // element that displays the shipping rates
            this.$subTotal = this.$element.find( "#stotal" ); // element that displays the subtotal charges
            this.$shoppingCartActions = this.$element.find( "#shopping-cart-actions" ); // cart actions links
            this.$updateCartBtn = this.$shoppingCartActions.find( "#update-cart" ); // update cart button
            this.$emptyCartBtn = this.$shoppingCartActions.find( "#empty-cart" ); // empty cart button
            this.$userDetails = this.$element.find( "#user-details-content" ); // element that displays the user's information
            this.$paypalForm = this.$element.find( "#paypal-form" ); // PayPal form

            this.currency = "&euro;"; // HTML entity of the currency to be displayed in layout
            this.currencyString = "€"; // currency symbol as text string
            this.paypalCurrency = "EUR"; // PayPal's currency code
            this.paypalBusinessEmail = "yourbusiness@email.com"; // your PayPal Business account email address
            this.paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // URL of the PayPal form

            // object containing patterns for form validation
            this.requiredFields = {
                expression: {
                    value: /^([w-.]+)@((?:[w]+.)+)([a-z]){2,4}$/
                },

                str: {
                    value: ""
                }

            };

            // public methods invocation
    }
};
