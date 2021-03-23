<iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLx0sYbCqOb8TBPRdmBHs5Iftvv9TPboYG" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

<button id="unmuteButton">silence</button>

<script>
  unmuteButton.addEventListener('click', function() {
    video.muted = false;
  });
</script>

<main class="uk-padding-remove-horizontal uk-padding uk-padding-remove render">

<div id="machine_render" class="_uk-container _uk-container-large" style="position:relative;  padding:0!important;" 
data-ecran="<?= isset($_GET['code']) ? $_GET['code'] : null ?>" 
data-mode-flux="<?= isset($scene_initiale['mode_flux']) ? $scene_initiale['mode_flux'] : null ?>" 
data-scene-initale="<?= isset($scene_initiale['id']) ? $scene_initiale['id'] : null ?>"
data-current-scene="<?= isset($scene_initiale['id']) ? $scene_initiale['id'] : null ?>"
data-current-playlist="<?= isset($scene_initiale['id_playlist']) ? $scene_initiale['id_playlist'] : null ?>"
data-current-update="<?= isset($scene_initiale['date_update']) ? $scene_initiale['date_update'] : null ?>"
>
    
<?= isset($scene_initiale) && !empty($scene_initiale) ? $scene_initiale['html'] : 'aucune scene initiale' ?>  

</div>

<script>   

    jQuery(document).ready(function(){  

        $('.active').each(function(){
            $(this).removeClass('active')
        })   

        var render_bloc = $('#machine_render')

        render_bloc.css({'background-color' : $('#machine').css('background-color')})        
        
        // dans le cas normal
        render_bloc.find('.ui-widget-content').each(function(){           

            render_bloc.height(Number(window.innerHeight) - 0)
            $('#machine').height(Number(window.innerHeight) - 0).css({'padding' : 0})
            $('#machine').width(Number(window.innerWidth) - 0).css({'padding' : 0})




            /*console.log('top:'+$(this).attr('data-top'))
            console.log('left:'+$(this).attr('data-left'))
            console.log('right:'+$(this).attr('data-right'))
            console.log('bottom:'+$(this).attr('data-bottom'))
            console.log('*******************************************')*/

            ctop = (Number(parseFloat($(this).attr('data-top'))) * Number(window.innerHeight)) / 653
            cbottom = (Number(parseFloat($(this).attr('data-bottom'))) * Number(window.innerHeight)) / 653
            cleft = (Number(parseFloat($(this).attr('data-left'))) * Number(window.innerWidth)) / 1180
            cright = (Number(parseFloat($(this).attr('data-right'))) * Number(window.innerWidth)) / 1180
            //cwidth = ( Number($(this).width()) * Number(window.innerWidth) ) / 1180
            //cheight = ( Number($(this).height()) * Number(window.innerHeight) ) / 653

            cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(window.innerWidth) ) / 1180
            cheight = ( Number(parseFloat($(this).attr('data-height'))) * Number(window.innerHeight) ) / 653

            // on readapte la vue
            if(Number(window.innerWidth) / Number(window.innerHeight) > 1.8){
                adaptiveWidth = (Number(window.innerHeight) * 16 ) / 9
                $('#machine').width(adaptiveWidth).css({'padding' : 0, 'margin': '0 auto'})
                cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(adaptiveWidth) ) / 1180
                cleft = (Number(parseFloat($(this).attr('data-left'))) * Number(adaptiveWidth)) / 1180
                cright = (Number(parseFloat($(this).attr('data-right'))) * Number(adaptiveWidth)) / 1180

            }

            /*console.log('ctop:'+ctop)
            console.log('cleft:'+cleft)
            console.log('cright:'+cright)
            console.log('cbottom:'+cbottom)
            console.log('cheight:'+cheight)
            console.log('cwidth:'+cwidth)
            console.log('*******************************************')*/

            //console.log('cheight:'+cheight)
            //console.log('cwidth:'+cwidth)

            $(this).width(cwidth).height(cheight).css({position: 'absolute'})

            if(Number(window.innerHeight) / 2 > (Number(ctop) + Number(cheight))){
                $(this).css({ top: ctop, bottom: 'none'})
            }else{
                if(Number(ctop) < (Number(window.innerHeight) - Number(cheight))){
                    $(this).css({ top: ctop, bottom: 'none'})
                }else{
                    $(this).css({ bottom: cbottom, top: 'none'})
                }
            }

            if(Number(window.innerWidth) / 2 > (Number(cleft) + Number(cwidth))){
                $(this).css({ left: cleft,  right: 'none'})
            }else{
                if(Number(cleft) < (Number(window.innerWidth) - Number(cwidth))){
                    $(this).css({ left: cleft,  right: 'none'})
                }else{
                    $(this).css({ right: cright,  left: 'none'})
                }
            }

            $(this).find('.inner_child').width(cwidth).height(cheight)

            // on readapte la vue
            if(Number(window.innerWidth) / Number(window.innerHeight) > 1.8){
                adaptiveWidth = (Number(window.innerHeight) * 16 ) / 9  
                cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(adaptiveWidth) ) / 1180 

                if(Number(window.adaptiveWidth) / 2 > (Number(cleft) + Number(cwidth))){
                    $(this).css({ left: cleft,  right: 'none'})
                }else{
                    if(Number(cleft) < (Number(window.adaptiveWidth) - Number(cwidth))){
                        $(this).css({ left: cleft,  right: 'none'})
                    }else{
                        $(this).css({ right: cright,  left: 'none'})
                    }
                }

                $(this).find('.inner_child').width(cwidth).height(cheight)
            }
        })

        // dans le cas du full screen
        $(window).on('resize', function(){
            if(screen.height === window.innerHeight){
                
                // dans le cas fullscreen
                render_bloc.find('.ui-widget-content').each(function(){           

                    render_bloc.height(Number(window.innerHeight) - 0)
                    $('#machine').height(Number(window.innerHeight) - 0).css({'padding' : 0})
                    $('#machine').width(Number(window.innerWidth) - 0).css({'padding' : 0})

                    /*console.log('top:'+$(this).attr('data-top'))
                    console.log('left:'+$(this).attr('data-left'))
                    console.log('right:'+$(this).attr('data-right'))
                    console.log('bottom:'+$(this).attr('data-bottom'))
                    console.log('*******************************************')*/

                    ctop = (Number(parseFloat($(this).attr('data-top'))) * Number(window.innerHeight)) / 653
                    cbottom = (Number(parseFloat($(this).attr('data-bottom'))) * Number(window.innerHeight)) / 653
                    cleft = (Number(parseFloat($(this).attr('data-left'))) * Number(window.innerWidth)) / 1180
                    cright = (Number(parseFloat($(this).attr('data-right'))) * Number(window.innerWidth)) / 1180
                    //cwidth = ( Number($(this).width()) * Number(window.innerWidth) ) / 1180
                    //cheight = ( Number($(this).height()) * Number(window.innerHeight) ) / 653

                    cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(window.innerWidth) ) / 1180
                    cheight = ( Number(parseFloat($(this).attr('data-height'))) * Number(window.innerHeight) ) / 653

                    // on readapte la vue
                    if(Number(window.innerWidth) / Number(window.innerHeight) > 1.8){
                        adaptiveWidth = (Number(window.innerHeight) * 16 ) / 9
                        $('#machine').width(adaptiveWidth).css({'padding' : 0, 'margin': '0 auto'})
                        cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(adaptiveWidth) ) / 1180
                        cleft = (Number(parseFloat($(this).attr('data-left'))) * Number(adaptiveWidth)) / 1180
                        cright = (Number(parseFloat($(this).attr('data-right'))) * Number(adaptiveWidth)) / 1180

                    }

                    /*console.log('ctop:'+ctop)
                    console.log('cleft:'+cleft)
                    console.log('cright:'+cright)
                    console.log('cbottom:'+cbottom)
                    console.log('cheight:'+cheight)
                    console.log('cwidth:'+cwidth)
                    console.log('*******************************************')*/

                    //console.log('cheight:'+cheight)
                    //console.log('cwidth:'+cwidth)

                    $(this).width(cwidth).height(cheight).css({position: 'absolute'})

                    if(Number(window.innerHeight) / 2 > (Number(ctop) + Number(cheight))){
                        $(this).css({ top: ctop, bottom: 'none'})
                    }else{
                        if(Number(ctop) < (Number(window.innerHeight) - Number(cheight))){
                            $(this).css({ top: ctop, bottom: 'none'})
                        }else{
                            $(this).css({ bottom: cbottom, top: 'none'})
                        }
                    }

                    if(Number(window.innerWidth) / 2 > (Number(cleft) + Number(cwidth))){
                        $(this).css({ left: cleft,  right: 'none'})
                    }else{
                        if(Number(cleft) < (Number(window.innerWidth) - Number(cwidth))){
                            $(this).css({ left: cleft,  right: 'none'})
                        }else{
                            $(this).css({ right: cright,  left: 'none'})
                        }
                    }

                    $(this).find('.inner_child').width(cwidth).height(cheight)

                    // on readapte la vue
                    if(Number(window.innerWidth) / Number(window.innerHeight) > 1.8){
                        adaptiveWidth = (Number(window.innerHeight) * 16 ) / 9
                        cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(adaptiveWidth) ) / 1180 

                        if(Number(window.adaptiveWidth) / 2 > (Number(cleft) + Number(cwidth))){
                            $(this).css({ left: cleft,  right: 'none'})
                        }else{
                            if(Number(cleft) < (Number(window.adaptiveWidth) - Number(cwidth))){
                                $(this).css({ left: cleft,  right: 'none'})
                            }else{
                                $(this).css({ right: cright,  left: 'none'})
                            }
                        }

                        $(this).find('.inner_child').width(cwidth).height(cheight)
                    }
                })
        }else{
                // dans le cas normal
                render_bloc.find('.ui-widget-content').each(function(){  


                    render_bloc.height(Number(window.innerHeight) - 0)
                    $('#machine').height(Number(window.innerHeight) - 0).css({'padding' : 0})
                    $('#machine').width(Number(window.innerWidth) - 0).css({'padding' : 0})

                    /*console.log('top:'+$(this).attr('data-top'))
                    console.log('left:'+$(this).attr('data-left'))
                    console.log('right:'+$(this).attr('data-right'))
                    console.log('bottom:'+$(this).attr('data-bottom'))
                    console.log('*******************************************')*/

                    ctop = (Number(parseFloat($(this).attr('data-top'))) * Number(window.innerHeight)) / 653
                    cbottom = (Number(parseFloat($(this).attr('data-bottom'))) * Number(window.innerHeight)) / 653
                    cleft = (Number(parseFloat($(this).attr('data-left'))) * Number(window.innerWidth)) / 1180
                    cright = (Number(parseFloat($(this).attr('data-right'))) * Number(window.innerWidth)) / 1180
                    //cwidth = ( Number($(this).width()) * Number(window.innerWidth) ) / 1180
                    //cheight = ( Number($(this).height()) * Number(window.innerHeight) ) / 653

                    cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(window.innerWidth) ) / 1180
                    cheight = ( Number(parseFloat($(this).attr('data-height'))) * Number(window.innerHeight) ) / 653

                    // on readapte la vue
                    if(Number(window.innerWidth) / Number(window.innerHeight) > 1.8){
                        adaptiveWidth = (Number(window.innerHeight) * 16 ) / 9
                        $('#machine').width(adaptiveWidth).css({'padding' : 0, 'margin': '0 auto'})
                        cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(adaptiveWidth) ) / 1180
                        cleft = (Number(parseFloat($(this).attr('data-left'))) * Number(adaptiveWidth)) / 1180
                        cright = (Number(parseFloat($(this).attr('data-right'))) * Number(adaptiveWidth)) / 1180

                    }

                    /*console.log('ctop:'+ctop)
                    console.log('cleft:'+cleft)
                    console.log('cright:'+cright)
                    console.log('cbottom:'+cbottom)
                    console.log('cheight:'+cheight)
                    console.log('cwidth:'+cwidth)
                    console.log('*******************************************')*/

                    //console.log('cheight:'+cheight)
                    //console.log('cwidth:'+cwidth)

                    $(this).width(cwidth).height(cheight).css({position: 'absolute'})

                    if(Number(window.innerHeight) / 2 > (Number(ctop) + Number(cheight))){
                        $(this).css({ top: ctop, bottom: 'none'})
                    }else{
                        if(Number(ctop) < (Number(window.innerHeight) - Number(cheight))){
                            $(this).css({ top: ctop, bottom: 'none'})
                        }else{
                            $(this).css({ bottom: cbottom, top: 'none'})
                        }
                    }

                    if(Number(window.innerWidth) / 2 > (Number(cleft) + Number(cwidth))){
                        $(this).css({ left: cleft,  right: 'none'})
                    }else{
                        if(Number(cleft) < (Number(window.innerWidth) - Number(cwidth))){
                            $(this).css({ left: cleft,  right: 'none'})
                        }else{
                            $(this).css({ right: cright,  left: 'none'})
                        }
                    }

                    $(this).find('.inner_child').width(cwidth).height(cheight)

                    // on readapte la vue
                    if(Number(window.innerWidth) / Number(window.innerHeight) > 1.8){
                        adaptiveWidth = (Number(window.innerHeight) * 16 ) / 9 
                        cwidth = ( Number(parseFloat($(this).attr('data-width'))) * Number(adaptiveWidth) ) / 1180  

                        //alert(cwidth)  

                        if(Number(window.adaptiveWidth) / 2 > (Number(cleft) + Number(cwidth))){
                            $(this).css({ left: cleft,  right: 'none'})
                        }else{
                            if(Number(cleft) < (Number(window.adaptiveWidth) - Number(cwidth))){
                                $(this).css({ left: cleft,  right: 'none'})
                            }else{
                                $(this).css({ right: cright,  left: 'none'})
                            }
                        }

                        //$(this).find('.inner_child').width(cwidth).height(cheight)
                        $(this).find('.inner_child').css({ width: cwidth,  height: cheight})
                    }
                })
            }
        })


        
        // check unique view
        setInterval(function() {
            current = $('#machine_render');
            url = "/check-screen-statut?code="+current.attr('data-ecran')
            axios({
                method: 'get',
                url: url,
            })
            .then(function (response) {
               
            })
            .catch(function (error) {
                //console.log(error);
            })

        }, 5000);


        // check unique view
        setInterval(function() {
            current = $('#machine_render');
            url = "/check-active-flux?code="+current.attr('data-ecran')
            axios({
                method: 'get',
                url: url,
            })
            .then(function (response) {
                if(isset(response.data.id) && response.data.id != current.attr('data-current-scene') && response.data.mode_flux != current.attr('data-mode-flux')){
                    /*current.attr('data-current-scene', response.data.id);
                    current.attr('data-mode-flux', response.data.mode_flux);
                    current.attr('data-current-update', response.data.date_update);
                    current.html(response.data.html)
                    current.css({'background-color' : $('body #machine').css('background-color')}) 
                    $(window).trigger('resize'); 
                    get_flux_continu(response.data.duree)*/
                    location.reload()
                }
            })
            .catch(function (error) {
                //console.log(error);
            })

        }, 5000);



    })

    get_flux_continu(<?= $scene_initiale['duree'] ?>)

    

    function get_flux_continu(duree){


        setTimeout(function(){

            current = $('#machine_render');
            url = "/render?ajax&code="+current.attr('data-ecran')+'&current_scene='+$('#machine_render').attr('data-current-scene')+'&current_playlist='+$('#machine_render').attr('data-current-playlist')

            axios.get(url)
            .then(function(response){
                current.attr('data-current-scene', response.data.id);
                current.attr('data-mode-flux', response.data.mode_flux);
                current.attr('data-current-update', response.data.date_update);
                current.html(response.data.html)
                current.css({'background-color' : $('body #machine').css('background-color')}) 
                $(window).trigger('resize'); 
                get_flux_continu(response.data.duree)
                //alert(1)                
            })
            .catch(function(error){
               console.log(error);
           })            
        },  Number(duree) * 1000);
    }

    function toggleVideoYoutube() {
        // if state == 'hide', hide. Else: show video
        var div = document.getElementById("machine_render");
        var iframe = div.getElementsByTagName("iframe")[0].contentWindow;
        iframe.postMessage('{"event":"command","func":"playVideo","args":""}','*');
    }

    toggleVideoYoutube();
</script>

 