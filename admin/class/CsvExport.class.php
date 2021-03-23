<?php 

class CsvExport {
    public function Export($datas,$name){       

            $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$name}.csv");
        header("Content-Transfer-Encoding: binary");

        $i = 0;
        foreach ($datas as $value) {
            if($i == 0){
                echo '"'.implode('";"',(array_keys($value))).'"'."\n";
            }
            echo '"'.implode('";"',($value)).'"'."\n";
            $i++;
        }
    }       
}

