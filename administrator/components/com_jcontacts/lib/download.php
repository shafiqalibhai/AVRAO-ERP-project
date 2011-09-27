<?php     include ('../../../../configuration.php');	$config = new JConfig();
	$file = $config->ftp_root."/administrator/components/com_jcontacts/tmp/".$_REQUEST['fileName'];
	if (!is_file($file)) { die("<b>404 File not found!</b>"); }
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));
   
    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "mpg":$ctype="video/mpeg"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        default: $ctype="application/force-download";
    }
   
    //Begin writing headers
    header("Cache-Control:");
    header("Cache-Control: public");
   
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
        # workaround for IE filename bug with multiple periods / multiple dots in filename
        # that adds square brackets to filename - eg. setup.abc.exe becomes setup[1].abc.exe
        $iefilename = preg_replace('/\./', '%2e', $filename, substr_count($filename, '.') - 1);
        header("Content-Disposition: attachment; filename=\"$iefilename\"");
    } else {
        header("Content-Disposition: attachment; filename=\"$filename\"");
    }
    header("Accept-Ranges: bytes");
   
    $size=filesize($file);
    //check if http_range is sent by browser (or download manager)
    if(isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range)=explode("=",$_SERVER['HTTP_RANGE']);
        //if yes, download missing part
        str_replace($range, "-", $range);
        $size2=$size-1;
        $new_length=$size2-$range;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range$size2/$size");
    } else {
        $size2=$size-1;
        header("Content-Range: bytes 0-$size2/$size");
        header("Content-Length: ".$size);
    }
    //open the file
    $fp=fopen("$file","rb");
    //seek to start of missing part
    fseek($fp,$range);
    //start buffered download
    while(!feof($fp)){
        //reset time limit for big files
        set_time_limit(0);
        print(fread($fp,1024*8));
        flush();
        ob_flush();
    }
    fclose($fp);

?>