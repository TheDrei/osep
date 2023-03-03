{{-- $(document).on('change', '#province_id', function(e){ 
   e.preventDefault() --}}
  

$("#province_id").on("change", function() {
   {{-- var selectedVal = $(this).find(':selected').val();
   var selectedText = $(this).find(':selected').text(); --}}

   {{-- alert(selectedVal) --}}
   {{-- alert(selectedText) --}}

   var province_id = $('#province_id').val(); 
   var agency_id = $('#agency_id').val(); 
   var action = $('#update_agency').val();                  
   if(province_id!=0){         
      $.ajax({
         type:"GET",
         url:"{{url('getMunicipalities')}}?province_id="+province_id,
         success:function(res){               
         if(res){   
               $("#municipality_id").empty();         
               $("#municipality_id").append('<option value="">Select Municipality</option>');
               $.each(res,function(key,value){
                  $("#municipality_id").append('<option value="'+key+'">'+value+'</option>');
                  $("#barangay_id").empty();                      
               });                
         }             
         else{
            $("#municipality_id").empty();                 
            $("#barangay_id").empty();
         }
         }
      })
   }
   else{
      $("#municipality_id").empty();          
      $("#barangay_id").empty();                        
   } 
});

$(document).on('change', '#municipality_id', function(e){ 
   var municipality_id = $('#municipality_id').val();     
   if(municipality_id!=0){
      $.ajax({
         type:"GET",
         url:"{{url('getBarangays')}}?municipality_id="+municipality_id,
         success:function(res){                                  
         if(res){
            $("#barangay_id").empty();
            $("#barangay_id").append('<option value="">Select Barangay</option>');
            $.each(res,function(key,value){
               $("#barangay_id").append('<option value="'+key+'">'+value+'</option>');
            });                       
         }
         else{
            $("#barangay_id").empty();                
         }
         }
      });
   }
   else{
      $("#barangay_id").empty();           
   }
});