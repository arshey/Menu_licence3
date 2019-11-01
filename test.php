INSERT INTO `users` (`id`, `name`, `last_name`, `picture`) VALUES (NULL, 'Vincent', 'vince', '');


<?php

        $imgFile = $_FILES['image']['name'];
		$tmp_dir = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];
		
		
		if(empty($apeltitre)){
			$errMSG = "titre manquant";
		}
		else if(empty($titre)){
			$errMSG = "Titre manquant.";
		}
		else if(empty($legende)){
			$errMSG = "legende manquante";
		}
		else if(empty($chapeau)){
			$errMSG = "chapeau manquant";
		}
		else if(empty($corps)){
			$errMSG = "Corps manquant";
		}
		else if(empty($auteur)){
			$errMSG = "auteur manquant";
		}
		else if(empty($datepub)){
			$errMSG = "Date manquante.";
		}
		else if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'user_images/'; 
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
		
			
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
		
			
			$image = rand(1000,1000000).".".$imgExt;
				
			
			if(in_array($imgExt, $valid_extensions)){			
				
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$image);
				}
				else{
					$errMSG = "Désolé l'image est un peu trop grande.";
				}
			}
			else{
				$errMSG = "Désolé seule les format 'jpeg', 'jpg', 'png', 'gif' sont autorisés";		
			}
		}
		