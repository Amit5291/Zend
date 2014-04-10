$(document).ready(function(){
    //--------------------------------------------------------------
      $("#add-user").click(function(){
         var id = $("#user-id").val();
         var status = $(this).val();
         if (status == "Add User") {
              $.post("../../profile/add",{ id : id},function(data){
              $("#add-user").val(data);  
            });
         }else if(status == "Accept Request"){
              $.post("../../profile/accept",{ id : id },function(data){
              $("#add-user").val(data);
              }); 
           }
        });
     //----------------------------------------------------------------
      $("#get-request").click(function(){
         
            $.post("../../profile/getrequest",{},function(data){
            $("#show-request").html(data);  
            });
         
        });
    });