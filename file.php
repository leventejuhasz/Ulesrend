 <?php 


$myfile= fopen("newfile.txt", "w") or die("Unable to open file");
$txt = "John doe\n";

fwriteU($myfile,$txt);
$txt = "john doe\n";
fwrite($myfile,$txt);
fclose($myfile);



        echo file_get_contents( $myfile ); 

        $old_name = "newfile.txt" ; 
        $new_name = "oldfile.txt" ; 
        rename( $new_name, $old_name) ;




$copy = "copyfile.txt";
        copy( $new_name, $copy);

echo file_get_contents( $copy ); 


file_put_contents("copyfile.txt", "");

?>