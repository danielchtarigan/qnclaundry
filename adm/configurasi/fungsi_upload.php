<?php

function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../images/foto_berita/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Ambil extensi file
  $img_type = $_FILES["fupload"]["size"];
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch (strtolower($img_type)){
	case "image/png":
		return $im_src = imagecreatefrompng($vfile_upload);
	break;
	case "image/gif":
		return $im_src = imagecreatefromgif($vfile_upload);
	break;
	case "image/jpg":
	case "image/jpeg":
		return $im_src = imagecreatefromjpeg($vfile_upload);
	break;
  }
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small  pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


function UploadDosen($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../images/foto_dosen/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Ambil extensi file
  $img_type = $_FILES["fupload"]["size"];
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch (strtolower($img_type)){
	case "image/png":
		$im_src = imagecreatefrompng($vfile_upload);
	break;
	case "image/gif":
		$im_src = imagecreatefromgif($vfile_upload);
	break;
	case "image/jpg":
	case "image/jpeg":
		$im_src = imagecreatefromjpeg($vfile_upload);
	break;
  }
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small  pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function UploadFasilitas($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../images/foto_fasilitas/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Ambil extensi file
  $img_type = $_FILES["fupload"]["size"];
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch (strtolower($img_type)){
	case "image/png":
		$im_src = imagecreatefrompng($vfile_upload);
	break;
	case "image/gif":
		$im_src = imagecreatefromgif($vfile_upload);
	break;
	case "image/jpg":
	case "image/jpeg":
		$im_src = imagecreatefromjpeg($vfile_upload);
	break;
  }
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small  pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

?>