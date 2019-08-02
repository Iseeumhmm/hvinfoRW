
$('.Jumbotron').click(function (event) 
{
    if (!$(event.target).closest('.Modal').length && !$(event.target).is('.Modal')  && !$(event.target).is('.Button')) {
        $( ".Modal" ).css( "display", "none" );
    }
});

function showRegister() {
    $( ".Modal-register" ).css( "display", "block" );
}
function showLogin() {
    $( ".Modal-login" ).css( "display", "block" );
}


