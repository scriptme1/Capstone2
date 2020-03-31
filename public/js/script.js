

$(document).ready(function(){
  //get category id


	$("#findBtn").click(function(e){  
      e.preventDefault();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
       var cat = $("#catId").val();
      var man = $("#manId").val();

      alert(cat);
      $.ajax({
        type:'GET',
        dataType:'html',
        url: 'productsCat',
       	data: {'cat_id' : cat,'man_id' : man}, 
         // data: 'man_id=' + man,
        success:function(response){
           console.log(response);
          $("#filteredProd").html(response);
        }
        // success : console.log(data),
        // console: data
       // 	success: function(response){
       // 	 $("#productData").html(response);
       	
      	// }
       
       	});
      
  	});
  
  	});