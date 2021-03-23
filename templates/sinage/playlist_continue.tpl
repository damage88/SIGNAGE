<style>
    #machine{
        _transform:scale(1.5); ;
    }

    #machine .ui-widget-content{
        __background: red!important;
        overflow: hidden;
    }

    #macine_render .ui-resizable-handle{
        display:none!important;
    }


    #machine_render{
        position:relative;
    }

    #machine_render .active > .fake_after:after, #machine_render .active > .fake_after:before, #machine_render .active:before, #machine_render .active:after,
    #machine_render .select_machine, #machine_render .todrag, #machine_render .ui-resizable-handle{
        display:none!important;
    }

    #machine_render .ui-widget-content,  #machine_render #machine{
        border: none!important;
    }
</style>
<main class="uk-padding-remove-horizontal uk-padding uk-padding-remove">
<div id="machine_render" class="_uk-container _uk-container-large" style="position:relative;  padding:0!important;" 

data-currentScene="<?= isset($scene['id']) ? $scene['id'] : null;  ?>" 
data-nextScene="<?= isset($next_scene['id']) ? $next_scene['id'] : null;  ?>" 
data-ecran="<?= isset($_GET['code']) ? $_GET['code'] : null ?>"
data-currentplaylist="<?= isset($scene['id_playlist']) ? $scene['id_playlist'] : null;  ?>"

>
    <?= isset($scene) && !empty($scene) ? $scene['html'] : 'aucune scene' ?>
</div>

<script>   

    jQuery(document).ready(function(){       

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

                if(Number(window.adaptiveWidth) / 2 > (Number(cleft) + Number(cwidth))){
                    $(this).css({ left: cleft,  right: 'none'})
                }else{
                    if(Number(cleft) < (Number(window.adaptiveWidth) - Number(cwidth))){
                        $(this).css({ left: cleft,  right: 'none'})
                    }else{
                        $(this).css({ right: cright,  left: 'none'})
                    }
                }

                $(this).find('.inner_child').width(adaptiveWidth).height(cheight)
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

                        if(Number(window.adaptiveWidth) / 2 > (Number(cleft) + Number(cwidth))){
                            $(this).css({ left: cleft,  right: 'none'})
                        }else{
                            if(Number(cleft) < (Number(window.adaptiveWidth) - Number(cwidth))){
                                $(this).css({ left: cleft,  right: 'none'})
                            }else{
                                $(this).css({ right: cright,  left: 'none'})
                            }
                        }

                        $(this).find('.inner_child').width(adaptiveWidth).height(cheight)
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

                        if(Number(window.adaptiveWidth) / 2 > (Number(cleft) + Number(cwidth))){
                            $(this).css({ left: cleft,  right: 'none'})
                        }else{
                            if(Number(cleft) < (Number(window.adaptiveWidth) - Number(cwidth))){
                                $(this).css({ left: cleft,  right: 'none'})
                            }else{
                                $(this).css({ right: cright,  left: 'none'})
                            }
                        }

                        $(this).find('.inner_child').width(adaptiveWidth).height(cheight)
                    }
                })
            }
        })


        $( window ).load(function() {
            //alert(1)
            //render_bloc.fadeIn('slow')
        })

        

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



    })

    get_flux_continu(<?= $scene['duree'] ?>)

    

    function get_flux_continu(duree){


        setTimeout(function(){

            current = $('#machine_render');
            url = "/get-playlist-continue?code="+current.attr('data-ecran')+'&current_scene='+$('#machine_render').attr('data-currentScene')+'&current_playlist='+$('#machine_render').attr('data-currentPlaylist')

            var strr = [];
            axios.get(url)
            .then(function(response){
                console.log(response.data.id)
                current.attr('data-nextDuree', response.data.duree);
                current.attr('data-nextScene', response.data.id);
                get_flux_continu(response.data.id)
                //current.fadeOut()
                document.location.replace('broadcasting?code='+current.attr('data-ecran')+'&scene='+response.data.id);
            })
            .catch(function(error){
               console.log(error);
           })            
        },  Number(duree) * 1000);
    }

    
    
</script>

 