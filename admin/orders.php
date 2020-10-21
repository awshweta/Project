
<?php
 include("config.php"); 
 include('header.php');
include('sidebar.php');
include('midtop.php'); ?>

            
    <div id="orders"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script>
              
           $( document ).ready( function() {
                $.ajax({
                method: "POST",
                url: "fetch_orders.php",
                data:{ action:'' },
                dataType: "json"
                }).done(function( msg ) {
                    $('#orders').html(msg.order);
                }); 
            });
                </script>
				</tbody>
			</table>
						
            </div> <!-- End #tab1 -->
            
            <div class="tab-content" id="tab2">
                
            </div> <!-- End #tab2 -->   
            </div> <!-- End .content-box-content -->
				
        </div> <!-- End .content-box -->
                
        <div class="clear"></div>

<?php include('footer.php');?>
