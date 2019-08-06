
$('.Jumbotron, .news-container').click(function (event) 
{
    if (!$(event.target).closest('.Modal').length && !$(event.target).is('.Modal')  && !$(event.target).is('.Button')) {
        $( ".Modal" ).css( "display", "none" );
    }
});

function showRegister() {
    $( ".Modal-login" ).css( "display", "none" );
    $( ".Modal-register" ).css( "display", "block" );
}
function showLogin() {
    $( ".Modal-register" ).css( "display", "none" );
    $( ".Modal-login" ).css( "display", "block" );
}


