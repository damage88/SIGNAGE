document.addEventListener("DOMContentLoaded", function()
{
    $(".ui-widget-content").bind("contextmenu", function(event)
    {
        event.preventDefault();
        var offsets = $('.ui-widget-content').offset();
        var infoTop = offsets.top;
        var infoLeft = offsets.left;
        var posLeft;
        var posTop;
        /*Get window size:*/
        var winWidth = $(".ui-widget-content").width();
        var winHeight = $(".ui-widget-content").height();
        var infoRight = winWidth + infoLeft;
        var infoBottom = winHeight + infoTop;
        /*Get pointer position:*/
        var posX = event.pageX;
        var posY = event.pageY;
        /*Get contextmenu size:*/
        var menuWidth = $(".contextmenu").width();
        var menuHeight = $(".contextmenu").height();
        var contextRight = posX + menuWidth;
        var contextBottom = posY + menuHeight;
        /*Prevent page overflow:*/
        posLeft = posX;
        posTop = posY;
        if( contextRight > infoRight )
        {
            posLeft -= (contextRight - infoRight) + 10;
        }
        if( contextBottom > infoBottom )
        {
            posTop -= (contextBottom - infoBottom) + 10;
        }
        $(".contextmenu")
            .appendTo(".ui-widget-content")
            .css({"left": posLeft + "px", "top": posTop + "px"})
            .show();
        }).bind("click", function(event)
        {
            $(".contextmenu").hide();
        });
        $( ".contextmenu" ).click(function(event)
        {
        if( event.target.text )
        {
            var menuClicked = event.target.text;
            alert("you clicked: " + menuClicked);
        }
    });
},false);