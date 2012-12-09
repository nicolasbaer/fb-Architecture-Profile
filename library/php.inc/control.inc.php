<?php
	// include config file
	require_once(__ROOT__.'/library/config.php');
	
	// include mysql library and repositories
	require_once(__ROOT__.'/library/php.inc/db/repository.php');
	
	

	function insertModelListItem($title, $architect, $userId) {
		
		echo '<div class="row-fluid" id="module_item_">
                        <div class="span2">
        						<div class="thumbnail thumb_li">
                                                 <img src="http://graph.facebook.com/'.$userId.'/picture" />
                                                    </div>
                           </div>
                        <div class="span6">'.$title.'<br />
'.$architect.'</div>
                <div class="span4">
                           <div class="btn-group">
                              <a class="btn" href="#"><i class="icon-eye-open icon-black"></i></a>
                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Fly to Model</a></li>
                                <li><a href="#">Unload Model</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Manage Model</a></li>
                              </ul>
                            </div> <!-- /btn group-->
                        </div>
                    </div>';
		
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
                </button>
            </a>
        </form>
    </div>
        

    <div id="collapseOne" class="accordion-body collapse">
        <div class="accordion-inner" id="menu_content">                    
            
                
            <!-- LOADED MODELS SECTION STARTS-->
            <div class="accordion-group">
            <div class="accordion-heading content-accordion">
                <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    Loaded Models
                </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse content-accordion">
            <div class="accordion-inner content-accordion-inner">

            <div class="scroll-section" id="loaded_list">

            
			  No models loaded at this time.</div>
            </div>
            </div>
            </div>
           <!-- LOADED MODELS SECTION ENDS-->
                
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
									insertModelListItem($building['building_name'], $building['user_name'], $building['user_id']);
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
									insertModelListItem($building['building_name'], $building['user_name'], $building['user_id']);
								}
							
							?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODELS OF FRIENDS AND PUBLIC MODELS SECTION ENDS-->
        
        </div>
        </div>
    </div>
</div>