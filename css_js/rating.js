function highlightStar(obj){ //obarva zvezdo med izbiro
    removeHightlight();
    $('li').each(function(index){ 
      $(this).addClass('highlight');
      if(index==$("li").index(obj)){ 
        return false;
      } 
    } );
  }
  
  function removeHightlight(){ //obarva nazaj na sivo med izbiro
    $('li').removeClass('selected');
    $('li').removeClass('highlight');
  }

  function addRating(obj) {  //po izbiri obarva zvezde
    $('li').each(function(index){ 
      $(this).addClass('selected');
      $('#rating').val((index+1));
      if(index== $("li").index(obj)){ 
        
        return false;
      } 
    } );
  }
  
  function resetRating(){ //resetira rating za novo ibero
    if($("#rating").val()){ 
      $('li').each(function(index){ 
        $(this).addClass('selected');
        if((index+1)==$("#rating").val()){ 
          return false;
        } 
      } );
    } 
  } 