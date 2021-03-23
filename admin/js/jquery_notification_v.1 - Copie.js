/**
 * Javascript functions to show top notification
 * Error/Success/Info/Warning messages
 * Developed By: Ravi Tamada
 * url: http://androidhive.info
 * © androidhive.info
 * 
 * Created On: 10/4/2011
 * version 1.0
 * 
 * Usage: call this function with params 
 showNotification(params);
 **/

function showNotification(params){
    // options array
    var options = { 
        'showAfter': 0, // number of sec to wait after page loads
        'duration': 0, // display duration
        'autoClose' : false, // flag to autoClose notification message
        'type' : 'success', // type of info message error/success/info/warning
        'message': '', // message to dispaly
        'link_notification' : '', // link flag to show extra description
        'description' : '' // link to desciption to display on clicking link message
    }; 
    // Extending array from params
    $.extend(true, options, params);
    
    var msgclass = 'succ_bg'; // default success message will shown
    var icoclass = 'ico_succ'; // ajout de l'icone
    if(options['type'] == 'error'){
        msgclass = 'error_bg'; // over write the message to error message
        icoclass = 'ico_error'; // ajout de l'icone
    } else if(options['type'] == 'information'){
        msgclass = 'info_bg'; // over write the message to information message
        icoclass = 'ico_info'; // ajout de l'icone
    } else if(options['type'] == 'warning'){
        msgclass = 'warn_bg'; // over write the message to warning message
        icoclass = 'ico_warn'; // ajout de l'icone
    } 
    
    // Parent Div container
    var container = '<div id="info_message" class="'+msgclass+'"><span class="zone_message"><span class="info_message_text message_area .icone '+icoclass+'">';
        container += options['message'];
        container += '</span><span class="info_close_btn button_area" onclick="return closeNotification()"></span><div class="clearboth"></div>';
        container += '</span></div>';
    
    $notification = $(container);
    
    // Appeding notification to Body
    if ($('div#info_message').length) {
        $('div#info_message').fadeOut('slow',function(){
            $(this).remove();
            clearTimeout(A);
        });
    };
    $('body').append($notification);
    
    var divHeight = $('div#info_message').height();
    // see CSS top to minus of div height
    
        if(options['type'] == 'error'){
            $('div#info_message').css({top : '0px'});
        }else{
            $('div#info_message').css({top : '-'+divHeight+'px'});
        }
    
    
    // showing notification message, default it will be hidden
    $('div#info_message').fadeIn(100);
    
    // Slide Down notification message after startAfter seconds
    slideDownNotification(options['showAfter'], options['autoClose'],options['duration']);
    
    /*$('.link_notification').live('click', function(){
        $('.info_more_descrption').html(options['description']).slideDown('fast');
    });*/
    
}

// function to close notification message
// slideUp the message
function closeNotification(duration){
    var divHeight = $('div#info_message').height();
    A = setTimeout(function(){
        $('div#info_message').animate({top: '-'+divHeight});
        // removing the notification from body
        setTimeout(function(){
            $('div#info_message').remove();
        },10);
    }, parseInt(duration * 1000));   
    

    
}

// sliding down the notification
function slideDownNotification(startAfter, autoClose, duration){
    setTimeout(function(){
        $('div#info_message').animate({
            top: 0
        }); 
        if(autoClose){
            A = setTimeout(function(){
                closeNotification(duration);
            }, duration);
        }
    }, parseInt(startAfter * 1000)); 
}




