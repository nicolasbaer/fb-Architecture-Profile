<?php
	// include config file
	require_once(__ROOT__.'/library/config.php');
	
	// include mysql library and repositories
	require_once(__ROOT__.'/library/php.inc/db/repository.php');
	
	




?>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=302169083216716";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$('.fixedVersion .modal').appendTo($("body"));
</script>
	
<div class="well well-small" style="right" id="details_well">
	<div class="accordion" id="details-accordion">
  		<div class="accordion-group">
  			<!-- header of datails panel starts-->
    		<div class="navbar-inner">
    			<div id="details-header">
        			ModelName - DesignerName
            		<a class="accordion-toggle" data-toggle="collapse" data-parent="#details-accordion" href="#details-collapse">
                		<button class="btn pull-right" id="toggle_button_details" onclick="changeToggleButtonIcon('toggle_button_icon_details')">
                    		<i class="icon-chevron-up" id="toggle_button_icon_details"></i>
                		</button>
            		</a>
        		</div>
    		</div>
    		<!-- header of datails panel ends-->
    		<!-- content section of details panel starts -->
    		<div id="details-collapse" class="accordion-body collapse">
      			<div class="accordion-inner">
      				<!-- tabs header section starts -->
        			<ul class="nav nav-tabs" id="details-tabs">
  						
  						<li class="active">
    						<a href="#feedback" data-toggle="tab">Feedback</a>
  						</li>
  						
  						<li>
  							<a href="#details" data-toggle="tab">Details</a>

  						</li>
  						<li>
  							<a href="#designer" data-toggle="tab">The Designer</a>
  						
  						</li>
					</ul>
					<!-- tabs header section ends -->
					<!-- tabs content sections start -->
					<div id="tabs-content" class="tab-content">
						<!-- Feedback Tab starts -->
						<div class="tab-pane fade active in" id="feedback">
							<!-- Average rating section starts -->
							<span class="label label-info">
								Average Rating
							</span>
							<span>
								<small>
									based on X ratings
								</small>
							</span>
							<span class="badge badge-success pull-right">
								5
							</span>
							<!-- Average rating section ends -->
							<ul class="nav nav-list">
  								<li class="divider"></li>
							</ul>							
							<!-- List comments section starts -->
							<div class="scroll-section" id="comments-list">
								<!-- First comment section starts -->
								<div class="row-fluid comment">
                        			<div class="span3 comment_thumbnail_span">
        								<div class="thumbnail thumb-for-list">
                                        	<img src="http://placehold.it/160x120" />
                                        </div>
                           			</div>
                        			<div>
                        				<span>
                        					Name of Commenter
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										<span class="badge badge-warning pull-right">
											2
										</span>										
										<p id="comment-string">
											<small>
												Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.  
											</small>
										</p>
									</div>
                    			</div>
                    			<!-- First comment section ends -->
                    			<!-- separator between comments starts-->
                    			<br/>
								<ul class="nav nav-list">
  									<li class="divider"></li>
								</ul>
								<!-- separator between comments ends-->
								<!-- Second comment section starts -->
								<div class="row-fluid comment">
                        			<div class="span3 comment_thumbnail_span">
        								<div class="thumbnail thumb-for-list">
                                        	<img src="http://placehold.it/160x120" />
                                        </div>
                           			</div>
                        			<div>
                        				<span>
                        					Name of Commenter
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										<span class="badge badge-important pull-right">
											1
										</span>
										<p id="comment-string">
											<small>
												;)
											</small>
										</p>
									</div>
                    			</div>
                    			<!-- Second comment section ends -->
                    			<!-- separator between comments starts-->
                    			<br/>
								<ul class="nav nav-list">
  									<li class="divider"></li>
								</ul>
								<!-- separator between comments ends-->
								<!-- Third comment section starts -->
								<div class="row-fluid comment">
                        			<div class="span3 comment_thumbnail_span">
        								<div class="thumbnail thumb-for-list">
                                        	<img src="http://placehold.it/160x120" />
                                        </div>
                           			</div>
                        			<div>
                        				<span>
                        					Name of Commenter
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										<span class="badge badge-important pull-right">
											1
										</span>
										<p id="comment-string">
											<small>
												;)
											</small>
										</p>
									</div>
                    			</div>
                    			<!-- Third comment section ends -->
                       		</div>
                       		<!-- List comments section ends -->
							<ul class="nav nav-list">
  								<li class="divider"></li>
							</ul>
							<!-- post comment and rate section starts -->							
							<div>
								<span>
									<textarea rows="3" placeholder="Leave a comment ..."></textarea>
								</span>
								<span>
									<div class="pull-right">	
										<div class="btn-group pull-right" data-toggle="buttons-radio">
 											<button type="button" class="btn  btn-danger">1</button>
  											<button type="button" class="btn  btn-warning">2</button>
  											<button type="button" class="btn  btn-primary">3</button>
  											<button type="button" class="btn  btn-info">4</button>
  											<button type="button" class="btn  btn-success">5</button>
										</div>								
										<br/>
										<span>
											<div class="fb-like" data-send="false" data-layout="button_count" data-width="105" data-show-faces="false" data-font="arial"></div>
											<button type="submit" class="btn pull-right" id="submit-button">Post</button>
										</span>										
									</div>
								</span>							
							</div>
							<!-- post comment and rate section ends -->	
						</div>
						<!-- Feedback Tab ends -->
						<!-- Details Tab starts -->
						<div class="tab-pane fade" id="details">
							<div class="scroll-section" id="additional-data-list">
								<!-- first elemnt on list is always a description of the model without thumbnail-->
								<!-- Model description starts -->
								<div class="row-fluid comment">									
                        			<div>
                        				<span>
                        					Model Description
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							Last update: 12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										
										<p id="comment-string">
											<small>
												Model description Model description Model description 
												Model description Model description Model description 
												Model description Model description Model description 
												Model description Model description Model description 
											</small>
										</p>
									</div>									
                    			</div>
                    			<!-- Model description ends -->
								<!-- separator between meta item starts-->
                    			<br/>
								<ul class="nav nav-list">
  									<li class="divider"></li>
								</ul>
								<!-- separator between meta item ends-->
								<!-- First detail item starts -->
								<div class="row-fluid comment">									
                        			<div class="span4 comment_thumbnail_span">
                        				<a href="#modal2" class="thumbnail thumb-for-list" role="button" data-toggle="modal">
        									<img src="http://www.archipublic.com/tests/grundriss.jpg" alt="sample foodprint" /> 
                                        </a>
                                        <!-- Modal -->
										<div id="modal2" class="modal hide fade" style="display: none;">
  											<div class="modal-header">
    											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   												<h3 id="myModalLabel">Title of Meta Info Item</h3>
   												<time pull-right>12-Dec-2012</time>
 											</div>
  											<div class="modal-body">
    											<p><img src="http://www.archipublic.com/tests/grundriss.jpg"/> </p>
  											</div>
  											<div class="modal-footer" style="text-align:left">
  																	
    											<small>
												more info on meta info item more info on meta info item
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												</small>
  											</div>
										</div>
                           			</div>
                        			<div>
                        				<span>
                        					Title of Meta Info Item
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										
										<p id="comment-string">
											<small>
												more info on meta info item more info on meta info item
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
											</small>
										</p>
									</div>									
                    			</div>
                    			<!-- First detail item ends -->
								<!-- separator between meta item starts-->
                    			<br/>
								<ul class="nav nav-list">
  									<li class="divider"></li>
								</ul>
								<!-- separator between meta item ends-->
								<!-- Second detail item starts -->
								<div class="row-fluid comment">
                        			<div class="span4 comment_thumbnail_span">
                        				<a href="#modal1" class="thumbnail thumb-for-list" role="button" data-toggle="modal">
        									<img src="http://www.archipublic.com/tests/grundriss.jpg" alt="sample foodprint" /> 
                                        </a>
                                        <!-- Modal -->
										<div id="modal1" class="modal hide fade" style="display: none;">
  											<div class="modal-header">
    											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   												<h3 id="myModalLabel">Title of Meta Info Item</h3>
   												<time pull-right>12-Dec-2012</time>
 											</div>
  											<div class="modal-body">
    											<p><img src="http://www.archipublic.com/tests/grundriss.jpg"/> </p>
  											</div>
  											<div class="modal-footer" style="text-align:left">
  																	
    											<small>
												more info on meta info item more info on meta info item
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												more info on meta info item more info on meta info item 
												</small>
  											</div>
										</div>
                           			</div>
                        			<div>
                        				<span>
                        					info item
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										
										<p id="comment-string">
											<small>
												;)
											</small>
										</p>
									</div>									
                    			</div>
                    			<!-- Second detail item ends -->
							</div>
						</div>
						<!-- Details Tab ends -->
						<!-- Designer Tab starts -->
						<div class="tab-pane fade" id="designer">
							<!-- Average rating section starts -->
							<div class="row-fluid comment">
								<span>
									<div class="span3 comment_thumbnail_span">
        								<div class="thumbnail thumb-for-list">
                            		    	<img src="http://placehold.it/160x120" />
                            		    </div>
                           			</div>
                           		</span>
                           		<span>
                        			<div>
                        				<span>
                        					Name of Designer
                        				</span>
                        				<span>
											<small>
												number of models: 
											</small>
										</span>
										<span class="badge pull-right">
											23
										</span>
    	                    		</div>
        	                		<div>
										<span class="label label-info">
											Average Rating
										</span>
										<span>
											<small>
												based on X ratings
											</small>
										</span>
										<span class="badge badge-success pull-right">
											5
										</span>
									</div>
								</span>
							</div>
							<!-- Average rating section ends -->
							<!-- separator between designer rating and other models starts-->
                    		<br/>
							<ul class="nav nav-list">
  								<li class="divider"></li>
							</ul>
							<!-- separator between designer rating and other models ends-->
							<!-- List other models section starts -->
							<div class="scroll-section" id="other-models-list">
								<!-- First other model section starts -->
								<div class="row-fluid comment">
                        			<div class="span3 comment_thumbnail_span">
                        				<!-- here we need an image of the model -->
        								<div class="thumbnail thumb-for-list">
                                        	<a onclick="load-model-and-fly-to-model" href="#">
                                        		<img src="http://placehold.it/160x120" />
                                        	</a>
                                        </div>
                           			</div>
                        			<div>
                        				<span>
                        					<a onclick="load-model-and-fly-to-model" href="#">
                        						Titel of Model
                        					</a>
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										<span class="badge badge-warning pull-right">
											2
										</span>										
										<p id="comment-string">
											<small>
												Model description Model description Model description 
												Model description Model description Model description 
												Model description Model description Model description 
											</small>
										</p>
									</div>
                    			</div>
                    			<!-- First other model section ends -->
                    			<!-- separator between models starts-->
                    			<br/>
								<ul class="nav nav-list">
  									<li class="divider"></li>
								</ul>
								<!-- separator between models ends-->
								<!-- Second other model section starts -->
								<div class="row-fluid comment">									
                        			<div class="span3 comment_thumbnail_span">
                        				<!-- here we need an image of the model -->
        								<div class="thumbnail thumb-for-list">
        								    <a onclick="load-model-and-fly-to-model" href="#">
                                        		<img src="http://placehold.it/160x120" />
                                        	</a>
                                        </div>
                           			</div>
                        			<div>
                        				<span>
                        					<a onclick="load-model-and-fly-to-model" href="#">
                        						Titel of Model
                        					</a>
                        				</span>
                        				<span>
                        					<time>
                        						<small>
                        							12-Dec-2012
                        						</small>
                        					</time>
                        				</span>
										<span class="badge badge-info pull-right">
											3
										</span>										
										<p id="comment-string">
											<small>
												Model description ...  
											</small>
										</p>
									</div>									
                    			</div>
                    			<!-- Second other model section ends -->                			
							</div>
							<!-- List other models section ends -->												
						</div>
						<!-- Designer Tab ends -->						
					</div>
      				<!-- tabs content sections end -->
      			</div>
    		</div>
  			<!-- content section of details panel ends -->
  		</div>
	</div> 
</div> 
  




