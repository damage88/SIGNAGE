var tpl_calque = '<div class="ui-widget-content" style="z-index:30; width:100px;height:100px; top:10px;left:10px;position:absolute"><span class="todrag"><i class="fa fa-arrows" aria-hidden="true"></i></span><span class="fake_after"></span></div>'
var tpl_image = '<div class="ui-widget-content" style="z-index:30; width:100px;height:100px; top:10px;left:10px;position:absolute"><span class="todrag"><i class="fa fa-arrows" aria-hidden="true"></i></span>image<span class="fake_after"></span></div>'
var tpl_p = '<div class="ui-widget-content texte" style="z-index:30; width:100px;height:100px; top:10px;left:10px;position:absolute; padding:10px;" ><span class="todrag"><i class="fa fa-arrows" aria-hidden="true"></i></span><div class="inner_text" contenteditable="true">Texte exemple</div><span class="fake_after"></span></div>'
var tpl_marquee = '<div class="ui-widget-content texte" style="z-index:30; width:100px;height:100px; top:10px;left:10px;position:absolute; padding:10px;" ><span class="todrag"><i class="fa fa-arrows" aria-hidden="true"></i></span><marquee><div class="inner_text" contenteditable="true">Texte exemple</div></marquee><span class="fake_after"></span></div>'
//var tpl_p = '<div contenteditable="true" autofocus="true"></div>' 

//var contextmenu = '<ul class="contextmenu"><li class="contextmenu-title"><a href="#">Title</a></li><li id="cut"><a href="#"><i class="fa fa-scissors"></i>Cut</a></li><li id="copy"><a href="#"><i class="fa fa-files-o"></i>Copy</a></li><li id="paste" class="disabled"><a href="#"><i class="fa fa-clipboard"></i>Paste</a></li><li class="contextmenu-divider"><a href="#"></a></li><li id="delete"><a href="#"><i class="fa fa-times"></i>Delete</a></li></ul>'

$(document).ready(function(){

    // initialisation 

    $('#machine .ui-widget-content').draggable().resizable({handles: "n, e, s, w"})
    $('#machine .ui-widget-content.texte').draggable({ handle: ".todrag" }).resizable({handles: "n, e, s, w"})
    /*************************************************************/

    //$( "#machine .ui-widget-content" ).resizable( "enable" );
    //alert($( "#machine .ui-widget-content" ).size())



    var height = ( Number($('#machine').width()) * 9 ) / 16
    $('#machine').height(653)
    //$('#machine_render').height(Number(height) + 30).width(Number($('#machine').width()) + 50)

    
    // selection du cadre machine
    $('#select_machine').on('click', function(){
        $('.ui-widget-content').removeClass('active')
        $('#machine').addClass('active')
    })

    $('.frame').on('click', function(){
        $('#machine, .ui-widget-content, .frame').removeClass('active')
        $(this).addClass('active')
    })

    // ajout de cadre
    $('.calque').on('click', function(){
        //$('.ui-widget-content').removeClass('active')
        //$('#machine').removeClass('active')

        $('.active:not(.frame)').each(function(){
            $(this).removeClass('active')
        })
        



        if($(this).attr('data-tpl') == 'tpl_calque'){

            if($('.frame.active').length){
                $(tpl_calque).appendTo('.frame.active').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }else{
                $(tpl_calque).appendTo('#machine').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }
            
        }else if($(this).attr('data-tpl') == 'tpl_p'){            

            if($('.frame.active').length){
                $(tpl_p).appendTo('.frame.active').draggable({ handle: ".todrag" }).resizable({handles: "n, e, s, w"}).addClass('active');
            }else{
                $(tpl_p).appendTo('#machine').draggable({ handle: ".todrag" }).resizable({handles: "n, e, s, w"}).addClass('active');
            }

        }else if($(this).attr('data-tpl') == 'tpl_image'){            

            if($('.frame.active').length){
                $(tpl_image).appendTo('.frame.active').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }else{
                $(tpl_image).appendTo('#machine').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }

        }else if($(this).attr('data-tpl') == 'tpl_marquee'){            

            if($('.frame.active').length){
                $(tpl_marquee).appendTo('.frame.active').draggable({ handle: ".todrag" }).resizable({handles: "n, e, s, w"}).addClass('active');
            }else{
                $(tpl_marquee).appendTo('#machine').draggable({ handle: ".todrag" }).resizable({handles: "n, e, s, w"}).addClass('active');
            }
        }

        $('.ui-widget-content.active').attr({'data-width': $('.active').css('width'), 'data-height' : $('.active').css('height')})
        $('.ui-widget-content.active').attr({'data-top': $('.active').css('top'), 'data-left' : $('.active').css('left')})
        $('.ui-widget-content.active').attr({'data-right': $('.active').css('right'), 'data-bottom' : $('.active').css('bottom')})
    })

    //selection de cadre

    $('#machine').on('click', '.ui-widget-content', function(){
        $('.ui-widget-content').removeClass('active')
        $('#machine').removeClass('active')        
        $(this).addClass('active')
        $('.menu .contextmenu a').show()
    })

    //ajout type de contenu

    $('#machine').on('click', '.text', function(){
        //$('.ui-widget-content').removeClass('active')
        $(this).parent('.ui-widget-content').append(tpl_p)
        $(this).remove()

    })

    // ajout d'image

    $("#img_url_temp").observe_field(1, function( ) {
        if($(this).val() != ''){
            $('.active:not(.frame)').each(function(){
                $(this).removeClass('active')
            })

            var current_img = '<div class="ui-widget-content" style="width:50px;height:50px; top:10px;left:10px;position:absolute"><span class="todrag"><i class="fa fa-arrows" aria-hidden="true"></i></span><img src="images/'+$(this).val()+'" alt="" width="100%" class="__inner_child"><span class="fake_after"></span></div>'
            
            if($('.frame.active').length){
                $(current_img).appendTo('.frame.active').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }else{
                $(current_img).appendTo('#machine').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }
        }
        $('#img_url_temp').attr('value', '')

        $('.ui-widget-content.active').attr({'data-width': $('.active').css('width'), 'data-height' : $('.active').css('height')})
        $('.ui-widget-content.active').attr({'data-top': $('.active').css('top'), 'data-left' : $('.active').css('left')})
        $('.ui-widget-content.active').attr({'data-right': $('.active').css('right'), 'data-bottom' : $('.active').css('bottom')})
    });


    // ajout de video

    $("#video_url_temp").observe_field(1, function( ) {
        if($(this).val() != ''){
            $('.active:not(.frame)').each(function(){
                $(this).removeClass('active')
            })

            current_video = '<div class="ui-widget-content" style="width:300px;height:150px; top:10px;left:10px;position:absolute; display:inline-block">'
            current_video += '<span class="todrag">'
            current_video += '<i class="fa fa-arrows" aria-hidden="true"></i>'
            current_video += '</span>'

            current_video += '<video __playsinline autoplay __muted loop class=" widget_video inner_child" width="100%">'
                current_video += '<source src="/images/'+$(this).val()+'" type="video/mp4">'
                current_video += 'Le navigateur ne prend pas en charge les vidéos.'
            current_video += '</video>'

            current_video += '<span class="fake_after"></span>'
            current_video += '</div>'
            

            if($('.frame.active').length){
                $(current_video).appendTo('.frame.active').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }else{
                $(current_video).appendTo('#machine').draggable().resizable({handles: "n, e, s, w"}).addClass('active');
            }
        }
        $(this).val('')

        $('.ui-widget-content.active').attr({'data-width': $('.active').css('width'), 'data-height' : $('.active').css('height')})
        $('.ui-widget-content.active').attr({'data-top': $('.active').css('top'), 'data-left' : $('.active').css('left')})
        $('.ui-widget-content.active').attr({'data-right': $('.active').css('right'), 'data-bottom' : $('.active').css('bottom')})
    });


    // chargement video youtube

    $("#load_video_youtube").on('click', function( ) {
        url_youtube = $('#url_youtube_video').val()
        

        if(url_youtube != ''){

            $('.active:not(.frame)').each(function(){
                $(this).removeClass('active')
            })

            yt_id = youtube_parser(url_youtube)

            current_yt = '<div class="ui-widget-content" style="width:300px;height:150px; top:10px;left:10px;position:absolute; display:inline-block">'
            current_yt += '<span class="todrag">'
            current_yt += '<i class="fa fa-arrows" aria-hidden="true"></i>'
            current_yt += '</span>'
            current_yt += '<div class="inner_widget">'
            current_yt += '<iframe class="_widget_video inner_child __widget_youtube" width="100%" height="150" src="https://www.youtube.com/embed/'+yt_id+'?autoplay=1&loop=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allow="autoplay"></iframe>'
            current_yt += '</div>'
            current_yt += '<span class="fake_after"></span>'
            current_yt += '</div>' 



            current_yt = '<div class="uk-position-relative uk-visible-toggle ui-widget-content" style="width:300px;height:150px; top:10px;left:10px;position:absolute; display:inline-block" uk-slideshow="animation: push">'
                current_yt += '<ul class="uk-slideshow-items">'                    
                    /*<li>
                        <video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" autoplay loop muted playsinline uk-cover></video>
                    </li>*/
                    current_yt += '<li>'
                        current_yt += '<iframe class="inner_child" src="https://www.youtube-nocookie.com/embed/'+yt_id+'?autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;playsinline=1" width="100%" height="150" frameborder="0" allowfullscreen __uk-cover></iframe>'
                    current_yt += '</li>'
                current_yt += '</ul>'
            current_yt += '</div>'         

            if($('.frame.active').length){
                $(current_yt).appendTo('.frame.active').draggable().resizable({handles: "n, e, s, w"}).addClass('active')
            }else{
                $(current_yt).appendTo('#machine').draggable().resizable({handles: "n, e, s, w"}).addClass('active')
            }
        }


        $('#url_youtube_video').val('')
        $('#yt_close').trigger('click')

        $('.ui-widget-content.active').attr({'data-width': $('.active').css('width'), 'data-height' : $('.active').css('height')})
        $('.ui-widget-content.active').attr({'data-top': $('.active').css('top'), 'data-left' : $('.active').css('left')})
        $('.ui-widget-content.active').attr({'data-right': $('.active').css('right'), 'data-bottom' : $('.active').css('bottom')})

        return false;
    });

    // application du background

    $("#apply_background").on('click', function( ) {
        url_background = $('#url_background').val()
        color_background = $('#color_background').val()
        size_background = $('#size_background').val()

        bg_style = 'background : '
        if(url_background != ''){

            bg_style += ' url(/images/'+url_background+') no-repeat top center,' 
            //$(current_yt).appendTo('#machine').draggable({ handle: ".todrag" }).resizable({handles: "n, e, s, w"}).addClass('active')
        }
        
        bg_style += color_background+';'
        bg_style += 'background-size:'+size_background+';'

        $('.active').css({backgroundSize: size_background, background: ' url(/images/'+url_background+') no-repeat top center,'+ color_background})

        $('#url_background').val('')
        $('#bg_close').trigger('click')
        return false;
    });

    // application du slider

    $("#apply_slider").on('click', function( ) {        
        
        $('.active:not(.frame)').each(function(){
            $(this).removeClass('active')
        })

        current_slider_raw = $(this).parents('.slider_node')

        
            
        
        slider_html = '<div class="uk-position-relative uk-visible-toggle uk-light slider inner_child" tabindex="-1" uk-slideshow="autoplay: true">'
            slider_html += '<ul class="uk-slideshow-items">'

            current_slider_raw.find('.slider_item').each(function(){
                current_image = $(this).find('input.img_value').val()
                if(current_image != ''){
                    slider_html += '<li><img src="/images/'+current_image+'" alt="" width="100%" uk-cover></li>'
                }
            })

            slider_html += '</ul>'
        slider_html += '</div>'

        current_slider = '<div class="ui-widget-content" style="width:300px;height:150px; top:10px;left:10px;position:absolute; display:inline-block">'
        current_slider += '<span class="todrag">'
        current_slider += '<i class="fa fa-arrows" aria-hidden="true"></i>'
        current_slider += '</span>'

        current_slider += slider_html

        current_slider += '<span class="fake_after"></span>'
        current_slider += '</div>'
        

        if($('.frame.active').length){
            $(current_slider).appendTo('.frame.active').draggable().resizable({handles: "n, e, s, w"}).addClass('active')
        }else{
            $(current_slider).appendTo('#machine').draggable().resizable({handles: "n, e, s, w"}).addClass('active')
        }
        //ajustement initial

        $('.active').attr({'data-width': $('.active').css('width'), 'data-height' : $('.active').css('height')})
        $('.active').attr({'data-top': $('.active').css('top'), 'data-left' : $('.active').css('left')})
        $('.active').attr({'data-right': $('.active').css('right'), 'data-bottom' : $('.active').css('bottom')})

        $('#sld_close').trigger('click')
        return false;
    });


    $( "#machine" ).on( "resize", ".ui-widget-content", function( event, ui ) {
        $(this).find('.inner_child').width($(this).width()).height($(this).height())
        $(this).attr({'data-width': $(this).css('width'), 'data-height' : $(this).css('height')})
        $(this).attr({'data-top': $(this).css('top'), 'data-left' : $(this).css('left')})
        $(this).attr({'data-right': $(this).css('right'), 'data-bottom' : $(this).css('bottom')})
    } );


    $( "#machine" ).on( "drag", ".ui-widget-content", function( event, ui ) {
        $(this).attr({'data-width': $(this).css('width'), 'data-height' : $(this).css('height')})
        $(this).attr({'data-top': $(this).css('top'), 'data-left' : $(this).css('left')})
        $(this).attr({'data-right': $(this).css('right'), 'data-bottom' : $(this).css('bottom')})
    } );


    // fancybox
    $(".fancybox").fancybox({'width': '600','height': '400','type': 'iframe','autoScale': false});

    // render

    $('#render').on('click', function(){
        var result = $("#wrap_machine").html()

        $('#machine_render').html(result)
        return false
    })

    $('#render_close').on('click', function(){
        $('#machine_render').html('')
    })

    


    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
   

  
})

function deleteCalque(){
    $('#machine').find('.ui-widget-content.active').remove()
    return false;
}

function upCalque(){
    current = $('#machine').find('.active')
    z_index = current.css( "z-index" )
    current.css('z-index', Number(z_index) + 1)
    return false;
}

function downCalque(){
    current = $('#machine').find('.active')
    z_index = current.css( "z-index" )
    current.css('z-index', Number(z_index) - 1)
    return false;
}

function lastCalque(){
    current = $('#machine').find('.active')
    z_index = current.css( "z-index" )
    current.css('z-index', 1)
    return false;
}

function firstCalque(){
    current = $('#machine').find('.active')
    z_index = current.css( "z-index" )
    current.css('z-index', 1000)
    return false;
}

function commande(nom, argument) {
  if (typeof argument === 'undefined') {
    argument = '';
  }
  // Exécuter la commande
  document.execCommand(nom, false, argument);
}


function saveSelection() {
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            var ranges = [];
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                ranges.push(sel.getRangeAt(i));
            }
            return ranges;
        }
    } else if (document.selection && document.selection.createRange) {
        return document.selection.createRange();
    }
    return null;
}

function restoreSelection(savedSel) {
    if (savedSel) {
        if (window.getSelection) {
            sel = window.getSelection();
            sel.removeAllRanges();
            for (var i = 0, len = savedSel.length; i < len; ++i) {
                sel.addRange(savedSel[i]);
            }
        } else if (document.selection && savedSel.select) {
            savedSel.select();
        }
    }
}

function createLink() {
    // There's actually no need to save and restore the selection here. This is just an example.
    var savedSel = saveSelection();
    var url = document.getElementById("url").value;
    alert(url)
    restoreSelection(savedSel);
    document.execCommand("CreateLink", false, url);
}


function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}