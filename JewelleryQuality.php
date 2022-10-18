<?php  include 'header.php'; 
include 'database/DatabaseConfig.php'; ?><br><br><br><br><br><br><br>
<style type="text/css">
.content-header{
  margin-top: -100px;
}
 @media (min-width: 768px) and (max-width: 992px) {
 
 .content-header{
  margin-top: 5px;
}
  
}
@media (min-width:320px){
  .card-with-shadow{
      margin-bottom: 200px; 
}
   
}
@media (min-width:425px){
  .card-with-shadow{
      margin-bottom: 200px; 
}
   
}


</style>
<?php
if(isset($_POST['submit'])== 'Save') {

 
  if(($_POST['id']) && ($_POST['id'] != "")){


    $update="update jewellery_quality set quality_name='".$_REQUEST["qualityname"]."',description='".$_REQUEST["description"]."'where id=".$_REQUEST["id"]." ";
    
    $query1 = mysqli_query($conn,$update);

    echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('JewelleryQuality Successfully Updated');
                </SCRIPT>";
      
    
  }else{ 

    $query = "insert into jewellery_quality(quality_name,description)values('".$_POST['qualityname']."','".$_POST['description']."')";

    
    $sqlquery = mysqli_query($conn,$query);


    echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('JewelleryQuality Successfully Saved');
                </SCRIPT>";


    $id=mysqli_insert_id();

    


  }
  echo"<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='JewelleryQuality.php';
</SCRIPT>";



}

$result1=null;

if((isset($_REQUEST['id'])) && ($_REQUEST['id'] != ""))
{
  $sql1 = mysqli_query($conn,"select * from jewellery_quality where id='".$_REQUEST["id"]."'");
  $result1 = mysqli_fetch_array($sql1);
}   
?>


<div class="container">
  
 

  <form class="form" method="POST" id="formId" name="formId" 
  action="<?php echo $_SERVER['PHP_SELF']; ?>"
  >
  <input type="hidden" name="id" id="id" value='<?php echo $result1["id"]; ?>' />
  <!-- notice modal -->
  <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
      <div class="modal-content">
       <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div style="text-align: center; font-size: 20px;"   >
                <label class="modal-title text-text-bold-300"
                id="myModalLabel33" >Jewellery Quality   
                </label>                    
              </div>
      </div>
      <div class="modal-body">
        <div class="instruction">
          <div class="row">
            <div class="form-group">
              <label >Jewellery Quality</label>
              <input type="text" class="form-control border-input" id="qualityname" name="qualityname" placeholder="Jewellery Name" autocomplete="off"  required="required" value='<?php echo $result1["quality_name"]; ?>' >

            </div>
            
          </div>
        </div>
        <div class="instruction">
          <div class="row">
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control border-input" id="description" name="description" placeholder="Description" autocomplete="off"   required="required" value='<?php echo $result1["description"]; ?>' >

            </div>

            
          </div>
        </div>
        <div class="buttons">
          <center>
           <button type="submit" class="btn btn-primary" value="Save" name="submit" >Save</button>
           <button type="reset" class="btn btn-waring" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-check2"></i> Close
           </button>  </center>


         </div>
         
       </div>
     </div>
   </div>

 </div>
</form>


<br>
<br>
<br>


<div class="content-body"><!-- Basic Tables start -->

  <div class="app-content content container-fluid" >
  <div class="content-wrapper">
    <div class="content-header row">
    
        <div class=" col-md-6 col-xs-10 ">
        <h4 class="content-header-title" style="
     color: #000000;"
>View Jewellery Quality</h4 >
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-10" style="text-align: right;">
          <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" 
         data-toggle="modal" data-target="#noticeModal" >
            <i class="icon-check2"></i>Add Jewellery Quality</button>
        </div>
      </div>
    </div>

<div class="row">
    <div class="col-xs-1"></div>

      <div class="col-xs-10">
          <div class="card card-with-shadow">
              
              <div class="card-body collapse in">
                 
                  <div class="table-responsive">
                              <table class="table mb-0">
<thead>            
    <tr>
      <th scope="col"><b>#</b></th>
      <th scope="col"><b>Jewellery Quality</b></th>
      <th scope="col"><b>Description</b></th>
      <th></th>

    </tr>
  </thead>






  <?php 
  $query=mysqli_query($conn,"select*from jewellery_quality");
  $count=mysqli_num_rows($query);
  if($count==0){
    ?>
     <td colspan="3" style="text-align: center;color: red"> <b>No Record</b>
                              </td>
    <?php
  }else{
    $i=1;
    while($result1 = mysqli_fetch_array($query))
    {
      ?>
      <tr>
       <th scope="row"><?php echo $i;?></th>
       <td>
        <?php echo $result1["quality_name"];?>
      </td>
      <td>
        <?php echo $result1["description"];?>
      </td>
      
      

      <td>
        <div class="form-actions right"> 
          <button type="submit" class="btn btn-primary"  onclick="categoryForm(<?php echo $result1["id"];?>);"><i class="icon-check2"></i> Edit
          </button>                     

          
          
          

        </div></td>

      </tr>
      
      <?php
      $i++;
    }

  }                       

  ?> 

  
</table>
</div>
</div></div></div></div></div></div></div></div>
<?php

if((isset($_REQUEST['id'])) && ($_REQUEST['id'] != "")) {

  echo"<SCRIPT LANGUAGE='JavaScript'> 
  $('#noticeModal').modal('show'); 
</SCRIPT>";

}
?>
<script type="text/javascript">
  function categoryForm(id){
    
    window.location.href="JewelleryQuality.php?id="+id;
  }

</script>
</div>
<?php 
include 'footer.php'; 
?>