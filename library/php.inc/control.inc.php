<?php
	// include config file
	require_once(__ROOT__.'/library/config.php');
	
	// include mysql library and repositories
	require_once(__ROOT__.'/library/php.inc/db/repository.php');
	
	

	function insertModelListItem($title, $architect, $userId, $kml, $latitude, $longitude, $buildingId) {
		
		global $facebook;
        $fbUser=$facebook->getUser();
		
		$manageButton="";
		if ($fbUser==$userId) {
			
			$manageButton='<a class="btn" onClick="#"><i class="icon-wrench icon-black"></i></a>"';
		}
		$userData = $facebook->api($userId);
		
		echo '<div class="row-fluid" id="module_item_">
                  <div class="span2">

                           <a href='.$userData['link'].' class="thumbnail thumb_li" target="_top">
                                 <img src="http://graph.facebook.com/'.$userId.'/picture" /> 
                           </a>
                   
                  </div>
                  <div class="span6">'.$title.'<br />
                  <a href='.$userData['link'].' target="_top">
                  '.$architect.'
                  </a>
                  </div>
                  <div class="span4">
                     <div class="btn-group pull-right">'
                           	.$manageButton.
                            '<a class="btn" onClick="setKmlAndPlacemark(\''.$kml.'\', '.$latitude.', '.$longitude.', '.$buildingId.');viewBuildingDetails('.$buildingId.');"><i class="icon-eye-open icon-black"></i></a>
                     </div> <!-- /btn group-->
                  </div>
             </div>
             <!-- separator between list entries sterts -->
             
             <ul class="nav nav-list">
                 <li class="divider"></li>
             </ul>
             <!-- separator between list entries ends-->';
	}
	



?>



<div class="well well-small" style="bottom" id="menu_well">
   
    <div class="navbar-inner">
        <form class="navbar-search pull-left">
            <input type="text" class="search-query" placeholder="enter name" name="search" id="search">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                <!-- onclick="return false" prevents page reload -->
                <button class="btn" id="toggle_button_control" onclick="changeToggleButtonIcon('toggle_button_icon_control')">
                    <i class="icon-chevron-up" id="toggle_button_icon_control"></i>
               
            </a>
        </form>
    </div>
        

    <div id="collapseOne" class="accordion-body collapse">
        <div class="accordion-inner" id="menu_content">                    
                
                <!-- MY MODELS SECTION STARTS-->
                <div class="accordion-group">
                <div class="accordion-heading content-accordion">
                    <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                        My Models
                    </a>
                </div>
                <div id="collapseThree" class="accordion-body collapse content-accordion">
                    <div class="accordion-inner content-accordion-inner">
                        
                        <div class="scroll-section" id="mymodels_list">
                            
                            <?php 
                  			
								$buildings = $repository->findAllBuildingsByUser($facebook->getUser());
								foreach($buildings as $building){
									insertModelListItem($building['building_name'], $building['user_name'], $building['user_id'], $building['kml_ref'], $building['x_coordinate'], $building['y_coordinate'], $building['building_id']);
								}
							
							?>
                
                        </div>
                    </div>
                </div>
                </div>
                <!-- MY MODELS SECTION ENDS-->
                
             <!-- MODELS OF FRIENDS AND PUBLIC MODELS SECTION STARTS-->
            <div class="accordion-group">
                <div class="accordion-heading content-accordion">
                    <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                        All models / Search
                    </a>
                </div>
                <div id="collapseFour" class="accordion-body collapse content-accordion">
                    <div class="accordion-inner content-accordion-inner">
                        
                        <div class="scroll-section" id="allmodels_list">
                            
                            <?php 
                  
								$buildings = $repository->findAllBuildingsVisibleToUser($facebook);
								
								foreach($buildings as $building){
									insertModelListItem($building['building_name'], $building['user_name'], $building['user_id'], $building['kml_ref'], $building['x_coordinate'], $building['y_coordinate'], $building['building_id']);
								}
							
							?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODELS OF FRIENDS AND PUBLIC MODELS SECTION ENDS-->
        	<div class="accordion-group">
        		<div class="accordion-heading content-accordion" onClick="window.open('http://www.archipublic.com/upload.php','Upload model','width=600,height=400')">
                    <a class="accordion-toggle " align="right">
						<button class="btn" id="upload" onClick="window.open('http://www.archipublic.com/upload.php','Upload model','width=600,height=400')">
                    	 Upload a model <i class="icon-eject" id="upload"></i>
                	</button>
                   </a>
                </div>
  			                
        	</div>
        	<!-- UPLOAD SECTION ENDS HERE-->

        </div>
        </div>
    </div>
</div>