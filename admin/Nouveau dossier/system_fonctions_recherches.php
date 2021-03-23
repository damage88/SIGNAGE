<?php 

function initialisation_recherche($functionRecherche,$espaceRecherche='#rech',$param_sup=null){
    global $page,$url;
    ob_start();
    if (function_exists($functionRecherche)): ?>
        <?php  $formRecherche = addslashes($functionRecherche()); ?>

        <script type="text/javascript">
        $("#rech").prev().show();
        $(".wrap_rech").show();
            if($.trim($("#rech").text()).length == 0){
                $("<?= $espaceRecherche; ?>").append("<?= $formRecherche; ?>");
            }
            var JS = "<?= $formRecherche; ?>";
            var JQ = $(JS);
            if(JQ.attr("init") != $("#rech").children().attr("init")){
                $("<?= $espaceRecherche; ?>").html("<?= $formRecherche; ?>");
            }
            $("#rech").children('form').attr('action','<?php echo $_SERVER["PHP_SELF"]."?action=liste".($param_sup?"&$param_sup":null) ?>');
        </script>

    <?php else: ?>

        <script type="text/javascript">
            $("#rech").prev().hide();
            $(".wrap_rech").hide();
            $("<?= $espaceRecherche; ?>").html("");
        </script>

    <?php endif;
    $rech = ob_end_flush();
}

function Recherche_Medium(){
    global $Form,$page;
    $html =  '<form  class="formRech" action="'.$page.'" method="get"  autocomplete="off" init="'.__FUNCTION__.'" onSubmit="recherche(this);return false;">';                                  
    $html .= '<label for="inputrech" class=""><b>Mots-Clés :</b></label>';
    $html .=  $Form->input('rech',array('type'=>'search','class'=>'input-medium l100p'));
    $html .=  $Form->radio('statut', '<b>Filtrer par Statut :</b>', array('on'=>'Activé','off'=>'Non-Activé','all'=>'Tout les éléments'),array(''=>'','class'=>'input-medium')); 
    //$html .= '<label for="inputdate" class=""><b>Date de Publication</b></label>';
    //$html .=  $Form->input('date',array('class'=>'l190 datepicker','placeholder'=>'Cliquer pour inserer Date')); 
    $html .=  $Form->radio('tri', "<b>Ordre d'affichage :</b>", array('date_asc'=>'Date Croissante','date_desc'=>'Date Décroissante'),array(''=>'','class'=>'input-medium')); 
    $html .=  $Form->radio('epp', "<b>Pagination :</b>", array('10'=>'10 lignes par page','25'=>'25 lignes par page','50'=>'50 lignes par page','100'=>'100 lignes par page'),array(''=>'','class'=>'input-medium')); 
    $html .= '<button type="submit" class="btn-bleu l75p" id="name_rech">Rechercher</button>';
    $html .= '<button type="reset" class="btn-bleu l21p" id="name_reset">C</button>';
    $html .= '</form>';

    return $html;
}

function Recherche_Mini(){
    global $Form,$page;
    $html =  '<form  class="formRech" action="'.$page.'" method="get"  autocomplete="off" init="'.__FUNCTION__.'" onSubmit="recherche(this);return false;">';                                  
    $html .= '<label for="inputrech" class=""><b>Mots-Clés :</b></label>';
    $html .=  $Form->input('rech',array('type'=>'search','class'=>'input-medium l100p'));
    $html .=  $Form->radio('statut', '<b>Filtrer par Statut :</b>', array('on'=>'Activé','off'=>'Non-Activé','all'=>'Tout les éléments'),array(''=>'','class'=>'input-medium')); 
    //$html .= '<label for="inputdate" class=""><b>Date de Publication</b></label>';
    //$html .=  $Form->input('date',array('class'=>'l190 datepicker','placeholder'=>'Cliquer pour inserer Date')); 
    $html .=  $Form->radio('tri', "<b>Ordre d'affichage :</b>", array('date_asc'=>'Date Croissante','date_desc'=>'Date Décroissante'),array(''=>'','class'=>'input-medium')); 
    //$html .=  $Form->radio('epp', "<b>Pagination :</b>", array('10'=>'10 lignes par page','25'=>'25 lignes par page','50'=>'50 lignes par page','100'=>'100 lignes par page'),array(''=>'','class'=>'input-medium')); 
    $html .= '<button type="submit" class="btn-bleu l75p" id="name_rech">Rechercher</button>';
    $html .= '<button type="reset" class="btn-bleu l21p" id="name_reset">C</button>';
    $html .= '</form>';

    return $html;
}

function Recherche_Micro(){
    global $Form,$page;
    $html =  '<form  class="formRech" action="'.$page.'" method="get"  autocomplete="off" init="'.__FUNCTION__.'" onSubmit="recherche(this);return false;">';                                  
    $html .= '<label for="inputrech" class=""><b>Mots-Clés :</b></label>';
    $html .=  $Form->input('rech',array('type'=>'search','class'=>'input-medium l100p'));
    $html .=  $Form->radio('statut', '<b>Filtrer par Statut :</b>', array('on'=>'Activé','off'=>'Non-Activé','all'=>'Tout les éléments'),array(''=>'','class'=>'input-medium')); 
    //$html .= '<label for="inputdate" class=""><b>Date de Publication</b></label>';
    //$html .=  $Form->input('date',array('class'=>'l190 datepicker','placeholder'=>'Cliquer pour inserer Date')); 
    //$html .=  $Form->radio('epp', "<b>Pagination :</b>", array('10'=>'10 lignes par page','25'=>'25 lignes par page','50'=>'50 lignes par page','100'=>'100 lignes par page'),array(''=>'','class'=>'input-medium')); 
    $html .= '<button type="submit" class="btn-bleu l75p" id="name_rech">Rechercher</button>';
    $html .= '<button type="reset" class="btn-bleu l21p" id="name_reset">C</button>';
    $html .= '</form>';

    return $html;
}

