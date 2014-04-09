$(document).ready(function(){
    //--------------------------------------------------------------
      $("#add-user").click(function(){
         var id = $("#user-id").val();
         var status = $(this).val();
         if (status == "Add User") {
              $.post("../../profile/add",{ id : id},function(data){
              $("#add-user").val(data);  
            });
         }else{
           alert("Already sent");
           }
        });
     //----------------------------------------------------------------
      $("#get-request").click(function(){
         
            $.post("../../profile/getrequest",{},function(data){
            $("#show-request").html(data);  
            });
         
        });
    });