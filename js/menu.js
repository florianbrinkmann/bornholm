var root = document.documentElement;
root.removeAttribute('class', 'no-js');
root.setAttribute('class', 'js');

var showMenu = function() {
    jQuery( 'body' ).toggleClass( 'active-menu' );
    jQuery( '.menu-button' ).toggleClass( 'active-button' );
    jQuery( '#main' ).click(function () {
        hideMenu();
    });
};

var hideMenu = function() {
    jQuery( 'body' ).removeClass( 'active-menu' );
    jQuery( '.menu-button' ).removeClass( 'active-button' );
};

jQuery( document ).ready( function( jQuery ) {
    jQuery( '.menu-button' ).click( function () {
        showMenu();
    });
});