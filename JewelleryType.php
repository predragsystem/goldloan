<?php  include 'header.php'; 
include 'database/DatabaseConfig.php'; ?>

<?php
if(isset($_POST['submit'])== 'Save') {

  

    if(($_POST['id']) && ($_POST['id'] != "")){


      $update="update jewellery_type set jewellery_name='".$_REQUEST["jewelleryname"]."',description='".$_REQUEST["description"]."'where id=".$_REQUEST["id"]." ";

      $query1 = mysqli_query($conn,$update);



 echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('JewelleryType Successfully Updated');
                </SCRIPT>";
      


    }else{ 

      $query = "insert into jewellery_type(jewellery_name,description)values('".$_POST['jewelleryname']."','".$_POST['description']."')";


      $sqlquery = mysqli_query($conn,$query);

      $id=mysqli_insert_id();

 echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('JewelleryType Successfully Saved');
                </SCRIPT>";

    }

  echo"<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='JewelleryType.php';
</SCRIPT>";

}

?>
<style>
.content-header{
  margin-top: 60px;
}
@media (min-width: 768px) and (max-width: 992px) {
 .content-header{
  margin-top: 150px;
}
  }

</style>

<div class="container">

 
  <?php
  $result1=null;

  if((isset($_REQUEST['id'])) && ($_REQUEST['id'] != ""))
  {
    $sql1 = mysqli_query($conn,"select * from jewellery_type where id='".$_REQUEST["id"]."'");
    $result1 = mysqli_fetch_array($sql1);
  }             
  ?>
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
                id="myModalLabel33" >Jewellery Type   
                </label>                    
              </div>
        </div>
        <div class="modal-body">
          <div class="instruction">
            <div class="row">
              <div class="form-group">
                <label >Jewellery Type</label>
                <input type="text" class="form-control border-input" id="jewelleryname" name="jewelleryname" placeholder="Jewellery Name" autocomplete="off"  required="required" value='<?php echo $result1["jewellery_name"]; ?>' >

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
           <input type="submit" class="btn btn-primary" value="Save" name="submit">
           <button type="reset" class="btn btn-waring" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-check2"></i> Cancel
        </button>  </center>

 <!-- <button type="reset" id="reset" class="btn btn-primary" 
 onclick="window.location.href='';">Reset</button>
 <br>
-->



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
>View Jewellery Type</h4 >
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-10" style="text-align: right;">
          <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" 
         data-toggle="modal" data-target="#noticeModal" >
            <i class="icon-check2"></i>Add Jewellery Type</button>
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
      <th scope="col"><b>Jewellery Type</b></th>
      <th scope="col"><b>Description</b></th>
      <th></th>

    </tr>
  </thead>






  <?php 
  $query=mysqli_query($conn,"select*from jewellery_type");
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
        <?php echo $result1["jewellery_name"];?>
      </td>
      <td>
        <?php echo $result1["description"];?>
      </td>



      <td>
        <div class="form-actions right"> 
          <button type="submit" class="btn btn-primary"   onclick="categoryForm(<?php echo $result1["id"];?>);"><i class="icon-check2"></i> Edit
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
</div>
</div>
<?php

if((isset($_REQUEST['id'])) && ($_REQUEST['id'] != "")) {

  echo"<SCRIPT LANGUAGE='JavaScript'> 
  $('#noticeModal').modal('show'); 
</SCRIPT>";

}
?>
<script type="text/javascript">
  function categoryForm(id){

    window.location.href="JewelleryType.php?id="+id;
  }

</script>



</div>
</div>
</div>
</div>
</div>
</div>
<?php 
include 'footer.php'; 
?>