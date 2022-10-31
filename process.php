<?
echo "process";
$sring = "expect -c 'spawn su - pibs16;expect ";
$sring = $sring.'"암호:";send "654987\r"';
$sring = $sring.";interact;';";

$input_output = "02";

//echo shell_exec('cd pifuhd
//sudo sh ./scripts/start.sh -i 03 -o 03');

$result = exec('cd pifuhd
sudo sh ./scripts/start.sh -i '.$input_output.' -o '.$input_output);

$is_same = './output/'.$input_output.'/'.$input_output.'_result.obj';

echo $result."///".$is_same;

if($result==$is_same){
    echo "변환완료";
} else {
    echo "변환실패";
}
//cd ../../../../home/pibs16/AR_project/pifuhd
//python -m apps.simple_test --input_path 02 --out_path 02
//expect -c 'spawn su - pibs16;expect "암호:";send "654987\r";interact;';
?>
<html>
<head>
</head>
<body>
</body>
</html>
