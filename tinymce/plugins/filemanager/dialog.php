<?
include 'config.php';

<<<<<<< HEAD
if (isset($_GET['fldr']) && !empty($_GET['fldr'])) {
    $subdir = trim($_GET['fldr'],'/') . '/';
}
else
    $subdir = '';

$cur_dir = $upload_dir . $subdir;

if (isset($_GET['del_file'])) {
    @unlink($root. $cur_dir . $_GET['del_file']);
}
if (isset($_GET['lang']) && $_GET['lang'] != 'undefined') {
    require_once 'lang/' . $_GET['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}
=======
function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        return false;
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

if (isset($_GET['fldr']) && !empty($_GET['fldr'])) {
    $subdir = trim($_GET['fldr'],'/') . '/';
}
else
    $subdir = '';

$cur_dir = $upload_dir . $subdir;
$cur_path = $current_path . $subdir;

if (isset($_GET['del_file'])) {
    @unlink($root. $cur_dir . $_GET['del_file']);
}

if (isset($_GET['del_folder'])) {
    @ deleteDir($root. $cur_dir . $_GET['del_folder']);
}

if (isset($_GET['lang']) && $_GET['lang'] != 'undefined') {
    require_once 'lang/' . $_GET['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}
>>>>>>> v2.0
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="noindex,nofollow">
<<<<<<< HEAD
            <title>Administration</title>
            <link href="css/fineuploader-3.5.0.css" rel="stylesheet" type="text/css" />
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="css/style.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="js/jquery.1.9.1.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/jquery.fineuploader-3.5.0.min.js"></script>
            <script>
                function createUploader() {
                    var uploader = new qq.FineUploader({
                        element: document.getElementById('bootstrapped-fine-uploader'),
                        multiple: false,
                        request: {
                            endpoint: 'upload.php',
                            params: {
                                lang : '<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>',
                                fldr : '<? echo $subdir ?>'
                            }
                        },
                        dragAndDrop: {
                            disableDefaultDropzone: true
                        },
                        text: {
                            uploadButton: '<i class="icon-upload icon-white"></i> <? echo lang_Upload_file; ?>'
                        },
                        template: '<div class="qq-uploader">' +
                            '<div class="qq-upload-button btn btn-primary pull-left" style="padding:8px;">{uploadButtonText}</div>' +
                            '<div class="pull-right span9"><span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
                            '<ul class="qq-upload-list" style="text-align: center;"></ul></div>' +
                            '</div>',
                        fileTemplate: '<li>' +
                            '<div class="qq-progress-container progress progress-warning progress-striped active"><div class="qq-progress-bar bar"></div></div>' +
                            '<span class="qq-upload-spinner"></span>' +
                            '<span class="qq-upload-finished"></span>' +
                            '<span class="qq-upload-file"></span>' +
                            '<span class="qq-upload-size"></span>' +
                            '<a class="qq-upload-cancel" href="#">{cancelButtonText}</a>' +
                            '<a class="qq-upload-retry" href="#">{retryButtonText}</a>' +
                            '<a class="qq-upload-delete" href="#">{deleteButtonText}</a>' +
                            '<span class="qq-upload-status-text">{statusText}</span>' +
                            '</li>',
                        classes: {
                            success: 'alert alert-success',
                            fail: 'alert alert-error'
                        },
                        failedUploadTextDisplay: {
                            mode: 'custom',
                            maxChars: 50,
                            responseProperty: 'error',
                            enableTooltip: true
                        },
                        callbacks: {
                            onComplete: function(id, fileName, responseJSON) {
                                if (responseJSON.success) {
                                    location.reload();
                                }
                            }
                        }
                    });
                }
                window.onload = createUploader;
                $(document).ready(function(){
                    $('input[name=radio-sort]').click(function(){
                        var li=$(this).attr('data-item');
                        if(li=='ff-item-type-all'){
                            $('.thumbnails li').fadeTo(500,1);
                            $('.thumbnails li a').show();
                        }else{
                            if($(this).is(':checked')){
                                $('.thumbnails li').not('.'+li).fadeTo(500,0.1);
                                $('.thumbnails li a').not('.'+li+' a').hide();
                                $('.thumbnails li.'+li).fadeTo(500,1);
                                $('.thumbnails li.'+li+' a').show();
                            }
                        }
                    });
                });
                function apply(file){
                    var path = '<? echo $cur_dir; ?>';
                    var track = $('#track').val();
                    var target = window.parent.document.getElementById(track+'_ifr');
                    var closed = window.parent.document.getElementsByClassName('mce-filemanager');
                    var ext_check=file.split('.');
                    var ext = ext_check[1];
                    var ext_img=new Array('<? echo implode("','", $ext_img)?>');
                    var fill='';
                    if($.inArray(ext, ext_img) > -1){
                        fill=$("<img />",{"src":path+file});
                    }else{
                        fill=$("<a />").attr("href", path+file).text(ext_check[0]);
                    }
                    $(target).contents().find('#tinymce').append(fill);
                    $(closed).find('.mce-close').trigger('click');
                }
                function apply_img(file){
                    var path = '<? echo $cur_dir; ?>';
                    var track = $('#track').val();
                    var target = window.parent.document.getElementsByClassName('mce-img_'+track);
                    var closed = window.parent.document.getElementsByClassName('mce-filemanager');
                    $(target).val(path+file);
                    $(closed).find('.mce-close').trigger('click');
                }
            </script>
            <input type="hidden" id="track" value="<? echo $_GET['editor']; ?>" />
            <div id="bootstrapped-fine-uploader" class="affix"></div>
            <br />
            <div class="container-fluid">
                <div class="row-fluid ff-container">
                    <div class="span2 affix">
                        <input id="select-type-all" name="radio-sort" type="radio" data-item="ff-item-type-all" />
                        <label for="select-type-all" class="btn ff-label-type-all"><? echo lang_All; ?></label>
                        <br />
                        <input id="select-type-1" name="radio-sort" type="radio" data-item="ff-item-type-1" checked="checked" />
                        <label for="select-type-1" class="btn ff-label-type-1"><? echo lang_Files; ?></label>
                        <br />    
                        <input id="select-type-2" name="radio-sort" type="radio" data-item="ff-item-type-2" />
                        <label for="select-type-2" class="btn ff-label-type-2"><? echo lang_Images; ?></label>
                        <br />
                        <input id="select-type-3" name="radio-sort" type="radio" data-item="ff-item-type-3" />
                        <label for="select-type-3" class="btn ff-label-type-3"><? echo lang_Archives; ?></label>
                    </div>
                    <div class="span10 pull-right">
=======
        <title>Administration</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-lightbox.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery.1.9.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-lightbox.min.js"></script>
		<script type="text/javascript" src="js/dropzone.min.js"></script>
		<script>
	    	var ext_img=new Array('<? echo implode("','", $ext_img)?>');
	    </script>
		<script type="text/javascript" src="js/include.js"></script>
    </head>
    <body>
		<input type="hidden" id="track" value="<? echo $_GET['editor']; ?>" />
		<input type="hidden" id="cur_dir" value="<? echo $cur_dir; ?>" />
		<input type="hidden" id="root" value="<? echo $root; ?>" />
		
<!----- uploader div start ------->
<div class="uploader">            
	<form action="upload.php" id="my-dropzone" class="dropzone">
		<input type="hidden" name="path" value="<?= $cur_path?>"/>
	</form>
	<center><button class="btn btn-large btn-primary close-uploader"><i class="icon-backward icon-white"></i> <?=lang_Return_Files_List?></button></center>
	<div class="space10"></div><div class="space10"></div>
</div>
<!----- uploader div start ------->

          <div class="container-fluid">
          
          
<!----- header div start ------->
			<div class="filters"><button class="btn btn-primary upload-btn" style="margin-left:5px;"><i class="icon-upload icon-white"></i> <?= lang_Upload_file?></button> 
			<button class="btn new-folder" style="margin-left:5px;"><i class="icon-folder-open"></i> <?= lang_New_Folder?></button> <div class="pull-right"><?echo lang_Filter?>: &nbsp;&nbsp;
			<input id="select-type-all" name="radio-sort" type="radio" data-item="ff-item-type-all" class="hide" />
                        <label id="ff-item-type-all" for="select-type-all" class="btn btn-info ff-label-type-all"><? echo lang_All; ?></label>
&nbsp;
                        <input id="select-type-1" name="radio-sort" type="radio" data-item="ff-item-type-1" checked="checked"  class="hide"  />
                        <label id="ff-item-type-1" for="select-type-1" class="btn ff-label-type-1"><? echo lang_Files; ?></label>
&nbsp;
                        <input id="select-type-2" name="radio-sort" type="radio" data-item="ff-item-type-2" class="hide"  />
                        <label id="ff-item-type-2" for="select-type-2" class="btn ff-label-type-2"><? echo lang_Images; ?></label>
&nbsp;
                        <input id="select-type-3" name="radio-sort" type="radio" data-item="ff-item-type-3" class="hide"  />
                        <label id="ff-item-type-3" for="select-type-3" class="btn ff-label-type-3"><? echo lang_Archives; ?></label>
&nbsp;
                        <input id="select-type-4" name="radio-sort" type="radio" data-item="ff-item-type-4" class="hide"  />
                        <label id="ff-item-type-4" for="select-type-4" class="btn ff-label-type-4"><? echo lang_Videos; ?></label>
&nbsp;
                        <input id="select-type-5" name="radio-sort" type="radio" data-item="ff-item-type-5" class="hide"  />
                        <label id="ff-item-type-5" for="select-type-5" class="btn ff-label-type-5"><? echo lang_Music; ?></label>
</div>
</div>

<!----- header div end ------->



<!----- breadcrumb div start ------->
				<div class="row-fluid">
				<? 
				$link="dialog.php?param=0";
				$link.=(isset($_GET['img_only']))?"&img_only=".$_GET['img_only']:"";
				$link.="&editor=";
				$link.=$_GET['editor'] ? $_GET['editor'] : 'mce_0';
				$link.="&lang=";
				$link.=$_GET['lang'] ? $_GET['lang'] : 'en_EN';
				$link.="&fldr="; 
				?>
				<ul class="breadcrumb">
				<li><a href="<?=$link?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
				<?
					$bc=explode('/',$subdir);
				$tmp_path='';
				if(!empty($bc))
				foreach($bc as $k=>$b){ 
					$tmp_path=$b."/";
					if($k==count($bc)-2){
				?> <li class="active"><?=$b?></li><?
					}elseif($b!=""){ ?>
					<li><a href="<?=$link.$tmp_path?>"><?=$b?></a> <span class="divider">/</span></li>
				<? }
				}
				?>
				</ul>
			</div>
<!----- breadcrumb div end ------->


                <div class="row-fluid ff-container">
                    <div class="span12 pull-right">
>>>>>>> v2.0
                        <ul class="thumbnails ff-items">
                            <?
                            $class_ext = '';
                            $src = '';
                            $dir = opendir($root . $cur_dir);
                            $i = 0;
<<<<<<< HEAD
=======
							$k=0;
>>>>>>> v2.0
                            if (isset($_GET['img_only']))
                                $apply = 'apply_img';
                            else
                                $apply = 'apply';
                            
                            $files = scandir($root . $cur_dir);
                            
                            //foreach ($files as $file) {
                            foreach ($files as $file) {
                                if (is_dir($root . $cur_dir . $file) && $file != '.' ) {
<<<<<<< HEAD
                                    $class_ext = 3;
                                    if($file=='..' && trim($subdir) != ''){
                                        //print_r(realpath($root . $cur_dir . $file));
                                        $src = str_replace($root.$upload_dir,'',realpath($root . $cur_dir . $file).'/');
=======
									if(($i+$k)%6==0 && $i+$k>0){
										?></div><div class="space10"></div><?
									}
									if(($i+$k)%6==0){
										?>
										<div class="row-fluid"><?
									}
                                    $class_ext = 3;
                                    if($file=='..' && trim($subdir) != ''){
                                        //print_r(realpath($root . $cur_dir . $file));
                                        $src = explode('/',$subdir);
										unset($src[count($src)-2]);
										$src=implode('/',$src);
>>>>>>> v2.0
                                    }
                                    elseif ($file!='..') {
                                        $src = $subdir . $file;
                                    }
                                    else{
                                        continue;
                                    }
<<<<<<< HEAD
                                    if ($k % 4 == 0) {
                                        $ml = 'noml';
                                    } else {
                                        $ml = '';
                                    }
                                    ?>
                                    <li class="span3 ff-item-type-dir <?=$ml?>">
                                        <div class="thumbnail">
                                            <h4><? echo $file ?></h4>
                                            <p class="clearfix">
                                                <a href="dialog.php?img_only=<?echo $_GET['img_only']?>&editor=<? echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?= $src ?>" class="btn btn-mini btn-primary pull-left">
                                                    <? echo lang_Open; ?>
                                                </a>
                                            </p>
=======
                                    ?>
                                    <li class="span2 ff-item-type-dir">
                                        <div class="boxes thumbnail">
                                            <? if($file!=".."){ ?>
                                            	<a href="dialog.php?del_folder=<? echo $file; ?>&img_only=<?echo $_GET['img_only']?>&editor=<? echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?= $subdir ?>" class="btn erase-button tip" onclick="return confirm('<? echo lang_Confirm_Folder_del; ?>');" title="<?=lang_Erase?>"><i class="icon-trash"></i></a>
											<? } ?>
											<a title="<?=lang_Open?>" href="dialog.php?img_only=<?echo $_GET['img_only']?>&editor=<? echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?= $src ?>">
<img class="directory-img"  src="ico/folder.png" alt="folder" />
                                            <h3><? echo $file ?></h3></a>
>>>>>>> v2.0
                                        </div>
                                    </li>
                                    <?
                                    $k++;
                                }
<<<<<<< HEAD
                            }

                            //while (false !== ($file = readdir($dir))) {
                            foreach ($files as $file) {
                                if ($file != '.' && $file != '..' && !is_dir($root . $cur_dir . $file)) {
                                    $ext = substr($file, -3);
                                    if ($ext == 'peg' || $ext == 'ocx' || $ext == 'lsx')
                                        $ext = substr($file, -4);
                                    if (in_array($ext, $ext_file)) {
                                        $class_ext = 1;
                                        $src = 'img/pdf.gif';
                                    } else if (in_array($ext, $ext_img)) {
                                        $class_ext = 2;
                                        $src = $wwwroot . $cur_dir . $file;
                                    } else if (in_array($ext, $ext_misc)) {
                                        $class_ext = 3;
                                        $src = 'img/compress.gif';
                                    }
                                    if ($i % 4 == 0) {
                                        $ml = 'noml';
                                    } else {
                                        $ml = '';
                                    }
                                    ?>
                                    <li class="span3 ff-item-type-<? echo $class_ext . ' ' . $ml; ?>">
                                        <div class="thumbnail">
                                            <img data-src="holder.js/140x100" alt="140x100" src="<? echo $src; ?>" height="100">
                                                <h4><? echo substr($file, 0, '-' . (strlen($ext) + 1)); ?></h4>
                                                <p class="clearfix">
                                                    <a href="#" onclick="<? echo $apply; ?>('<? echo $file; ?>')" class="btn btn-mini btn-primary pull-left">
                                                        <? echo lang_Select; ?>
                                                    </a>
                                                    <a href="dialog.php?del_file=<? echo $file; ?>&img_only=<?echo $_GET['img_only']?>&editor=<? echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?= $subdir ?>" class="btn btn-mini btn-danger pull-right" onclick="return confirm('<? echo lang_Confirm_del; ?>');">
                                                        <? echo lang_Erase; ?>
                                                    </a>
                                                </p>
=======
							}
							foreach ($files as $file) {
                                if ($file != '.' && $file != '..' && !is_dir($root . $cur_dir . $file)) {
									if(($i+$k)%6==0 && $i+$k>0){
										?></div><div class="space10"></div><?
									}
									if(($i+$k)%6==0){
										?>
										<div class="row-fluid"><?
									}
									$is_img=false;
                                    $file_ext = substr(strrchr($file,'.'),1);
									if(in_array($file_ext, $ext)){
									if(in_array($file_ext, $ext_img)){
										 $src = $wwwroot . $cur_dir . $file;
										 $is_img=true;
									}elseif(file_exists('ico/'.strtoupper($file_ext).".png")){
										$src = 'ico/'.strtoupper($file_ext).".png";
									}else{
										$src = "ico/Default.png";
									}

                                    if (in_array($file_ext, $ext_video)) {
                                        $class_ext = 4;
                                    }elseif (in_array($file_ext, $ext_img)) {
                                        $class_ext = 2;
                                    }elseif (in_array($file_ext, $ext_music)) {
                                        $class_ext = 5;
									}elseif (in_array($file_ext, $ext_misc)) {
                                        $class_ext = 3;
									}else{
                                        $class_ext = 1;
									}
                                    ?>
                                    <li class="span2 ff-item-type-<? echo $class_ext; ?>">
                                        <div class="boxes thumbnail">
											<form action="force_download.php" method="post" class="download-form">
											<input type="hidden" name="path" value="<?=$root. $cur_dir. $file?>"/>
											<input type="hidden" name="name" value="<?=$file?>"/>
                                                <div class="btn-toolbar">
												  <div class="btn-group">
											<button type="submit" title="<?=lang_Download?>" class="btn tip"><i class="icon-download"></i></button>
										  
                                            <? if($is_img){ ?>
                                            	<a class="btn preview tip" title="<?=lang_Preview?>" data-url="<?=$src;?>" data-toggle="lightbox" href="#demoLightbox"><i class=" icon-eye-open"></i></a>
                                            <? }else{ ?>
                                            	<a class="btn preview disabled"><i class=" icon-eye-open"></i></a>
                                            <? } ?>
                                            	<a href="dialog.php?del_file=<? echo $file; ?>&img_only=<?echo $_GET['img_only']?>&editor=<? echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?= $subdir ?>" class="btn erase-button tip" onclick="return confirm('<? echo lang_Confirm_del; ?>');" title="<?=lang_Erase?>"><i class="icon-trash"></i></a>
												  </div>
												</div>
                                            	</form>
                                            <a href="#" title="<?= lang_Select?>" onclick="<? echo $apply; ?>('<? echo $file; ?>')">
 <img data-src="holder.js/140x100" alt="140x100" src="<? echo $src; ?>" height="100">
                                                <h4><? echo substr($file, 0, '-' . (strlen($file_ext) + 1)); ?></h4></a>
												  
                                                    
>>>>>>> v2.0
                                        </div>
                                    </li>
                                    <?
                                    $i++;
<<<<<<< HEAD
                                }
                            }
=======
									}
                                }
                            }
?></div><?
>>>>>>> v2.0
                            closedir($dir);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
=======
        
	<!----- lightbox div end ------->    
	<div id="demoLightbox" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
		<div class='lightbox-content'>
			<img id="full-img" src="">
		</div>    
	</div>
	<!----- lightbox div end ------->
</body>
</html>
>>>>>>> v2.0
