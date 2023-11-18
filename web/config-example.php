<?php
$config=array(
	'refresh' => 32000,
	//	Cameras will get default names based on their filename
	//		You can optionally override this behavior by setting up a name array as below
	'cam_names' => array(
		"LivingRoom Cam",
		"Garage Cam",
	),
	// Some Cameras have web-pages or media streaming URLs
	//		If you include them here, clicking on the cam image will go to that RUI
	'cam_links' => array(
		"http://192.168.10.14:88/",
		"rtsp://camuser:campasword@192.168.10.16:88/videoMain",
	)
);
?>
