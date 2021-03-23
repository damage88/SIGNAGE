<main class="uk-padding-remove-horizontal uk-padding uk-padding-remove render">

<div id="machine_render" class="_uk-container _uk-container-large" style="position:relative;  padding:0!important;">
    
<?= isset($article) && !empty($article) ? $article['html'] : 'aucune scene' ?>

</div>

<script>   

    jQuery(document).ready(function(){   

        $('.active').each(function(){
            $(this).removeClass('active')
        })    

        var render_bloc = $('#machine_render')

        $('.frameset').height(Number(window.innerWidth))

        render_bloc.css({'background-color' : $('#machine').css('background-color')})        
        
        // dans le cas normal
        render_bloc.find('.ui-widget-content, .frame').each(function(){           

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
                render_bloc.find('.ui-widget-content, .frame').each(function(){           

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
                render_bloc.find('.ui-widget-content, .frame').each(function(){           

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

        

        


    })
    
</script>

 