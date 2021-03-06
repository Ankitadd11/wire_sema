<div class="container panel panel-body">
    <div id="append_brand_form" tabindex="-1" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" data-target="#myModal"></div>

    <div class="row">
        <div class="col-md-6">
            <!-- just part logo  -->
            <div class="row margin-bottom padding-5">
                <img src="<?php echo base_url(); ?>assests/images/JustParts-Logo.png">
            </div>
        </div>
        <div class="col-md-6">
                <div class="row padding-5">
                    <h2><b>Sema Data Co-Op</b></h2>
                </div> 
                <div class="row padding-5 sub-title-dashboard">
                    <h4>Data File Administration</h4>
                </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
             <div class="row title-orange">
                <h3><strong ><?php  echo $BrandData[0]["Name"]; ?></strong></h3>
            </div>
            <div class="row border-bottom padding-5">
                <h4><strong>Brand Summary</strong></h4>
            </div>
            <div class="row padding-5">
            
            <?php
                // echo "<pre>";
                // print_r($brand_data);
                // exit;
                foreach($BrandData as $brand):
            ?>
                <div class="col-md-5 padding-5"><span>Associated Date: </span></div><div class="col-md-7 padding-5"><span><?php echo (isset($brand['CreatedDate'])) ? $brand['CreatedDate'] : '-' ?></span></div>
                
                <div class="col-md-5 padding-5"><span>Last Data Refresh: </span></div><div class="col-md-7 padding-5"><span><b>August 31, 2018 at 2:10:52 PM</b></span></div>
                
                <div class="col-md-5 padding-5"><span>Number of Items: </span></div><div class="col-md-7 padding-5"><span><?php echo (isset($brand['NumberOfItem'])) ? $brand['NumberOfItem'] : '-' ?></span></div>

                <div class="col-md-5 padding-5"><span>SEMA Brand Class: </span></div><div class="col-md-7 padding-5"><span><?php echo (isset($brand['ClassName'])) ? $brand['ClassName'] : '-' ?></span></div>
                
 
            <?php
                endforeach;
            ?>
             <div class="col-md-5 padding-5"><span>Associate Sellers: </span></div><div class="col-md-7 padding-5"><span><?php echo (isset($NumberOfAssociateSeller[0]['AssociateSeller'])) ? $NumberOfAssociateSeller[0]['AssociateSeller'] : '-' ?></span></div>

                <div class="col-md-5 padding-5"><span>Associate Webstores: </span></div><div class="col-md-7 padding-5"><span><b>15</b></span></div>
            </div>
            
        </div>
        
        <div class="col-md-6 ">

            <div class="row border-bottom padding-5">
                <div class="col-md-6"> <h4><strong>Associated Seller</strong></h4></div>
                <div class="col-md-6 text-right color-blue"><h5>See all <?php echo (isset($NumberOfAssociateSeller[0]['AssociateSeller'])) ? $NumberOfAssociateSeller[0]['AssociateSeller'] : '-' ?>     sellers</h5></div>
            </div>

            <div class="row padding-5">
                <?php
                    if( isset( $seller_list ) && !empty( $seller_list ) ) {
                        foreach ($seller_list as $seller) { ?>
                            <div class="col-md-4 padding-5"><a class="SellerDisplay" value="<?php echo $seller["ID"]; ?>"><?php echo $seller["Name"]; ?></a> </div>
                            <?php
                        }
                    }
                ?>
            </div>

            <div class="row padding-5">
                <button type="button" id="AssociateSeller" class="btn btn-default btn-block">Associate New Seller</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
    $("a.SellerDisplay").click(function() {
        var BrandName = "<?php echo $BrandData[0]["Name"]; ?>";
        var BrandID = "<?php echo $BrandData[0]["ID"]; ?>";
        var data = {'id': $(this).attr('value'), "BrandName": BrandName,"BrandID":BrandID};
        var url = "<?php base_url()?>sellers";
         url_redirect({url:url,  method: "post",data: data});
    });

     function url_redirect(options){
        var $form = $("<form />");                 
        $form.attr("action",options.url);
        $form.attr("method",options.method);                 
        for (var data in options.data)
        $form.append('<input type="hidden" name="'+data+'" value="'+options.data[data]+'" />');                      
        $("body").append($form);
        $form.submit();
    }

     // open the asscoiate seller pop up
          $( "#AssociateSeller" ).click( function() {   
             var BrandID = "<?php echo $BrandData[0]["ID"]; ?>";     
             var BrandData = { "BrandID" : BrandID, "action" : "summary" };             
            $( "div.modal-backdrop" ).removeClass( "hide" );            
            $( "div.modal-backdrop" ).addClass( "show" );    
            $( "#append_brand_form" ).load( "<?php echo base_url().'sellers/AssociateSellerSummary'; ?> " , BrandData );
            $( "#append_brand_form" ).modal( "show" );
        });
});
</script>