<?
    $filename = $_GET["file"];
    $target_Dir = $_GET["target_Dir"];
    $file = $_SERVER['DOCUMENT_ROOT']."/".$target_Dir."/".$filename;
    /*
    echo $filename."<br>";
    echo $target_Dir."<br>";
    echo $file;
    */
    $filesize = filesize($file);

    if (is_file($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: '.filesize("$file"));
        ob_clean();
        flush();
        readfile($file);
        /*
        header("Content-type: application/octet-stream");
        header("Content-Length: ".filesize("$file"));
        header("Content-Disposition: attachment; filename=$filename"); // 다운로드되는 파일명 (실제 파일명과 별개로 지정 가능)
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Expires: 0");
        */

        /*
        if (preg_match("MSIE", $_SERVER['HTTP_USER_AGENT'])) {
        header("Content-type: application/octet-stream");
        header("Content-Length: ".filesize("$file"));
        header("Content-Disposition: attachment; filename=$filename"); // 다운로드되는 파일명 (실제 파일명과 별개로 지정 가능)
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Expires: 0");
        }else {
        header("Content-type: file/unknown");
        header("Content-Length: ".filesize("$file"));
        header("Content-Disposition: attachment; filename=$filename"); // 다운로드되는 파일명 (실제 파일명과 별개로 지정 가능)
        header("Content-Description: PHP3 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");
        }
        */
        /*
        $fp = fopen($file, "rb");
        fpassthru($fp);
        fclose($fp);
        */
    }
    else {
    ?>
        <script>
            alert("제품자료 파일이 없습니다");
            history.go(-1);
        </script>
    <?php
    }
?>
<?php
ob_start();
$version = 6;
 
$dir = './'.$version.'/';
$files = scandir($dir);
 
foreach( $files as $file)
{
if( is_file($dir.$file) )
{

}
}
 
exit();
?>
