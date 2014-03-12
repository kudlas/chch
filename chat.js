  $(document).ready(function () {
  
  var timeout = 2000;
  var maxPosts = 20;
  
  var dataToSend = { lastId: 0 };
  obtain(); // init obtaining
  
  /* lenghten timeout when not focused */
  $(window).blur(function(){
        timeout = 6000;
      });
      $(window).focus(function(){
        timeout = 2000;
      });
  
  /* sendin start */ 
   var sendButt = $("button.odeslat");
   
    sendButt.click(function (event) {
      
      event.preventDefault();
      
      var text = $(this).parent().find("input");
      var sendThis = text.val();
      
      if(sendThis)
      {
        text.prop("disabled",true);
        $.post( "handler.php",{send: sendThis}, function( data ) {
          
          // disable input when sending START **erase these lines to disable**   
          if(data)
          {
             text.val("");
             text.prop("disabled",false);
          }
          // disabling when sending STOP
          
        });        
      }
    });
    
    function addToBar(text,nck)
    {
            nck = typeof nck !== 'undefined' ? nck : 'System';
    
             var newPost = $("#bar div:first").clone();
             newPost.find("span.content").text(text);
             newPost.find("strong").text(nck);
             newPost.prependTo("#bar");
             
             showEffect(newPost);  // animation and shit
    }
    
    /* sendin end */ 
    
    function showEffect(newPost)
    {     
        autoHeight = newPost.css('height', 'auto').height();
    
        newPost.css({"opacity":0, "height" : "0px"});
        newPost.animate({"opacity":1,"height": autoHeight},"slow", "swing");  
    }
    
    function obtainOnline(data)
    {
      console.log("onlines nalezeny");
             var elem = $("#onlines");
             elem.text("");
             $.each(data["ONLINES"],function(key,val) {
               elem.append("<li>"+val["NICK"]+"</li>");            
             });
    }
    
    /* recievin start */
    
    function obtain()
    {
  
      console.log("tik");
  
      $.post( "handler.php",dataToSend, function( data ) {
         
         if(data!=0) {
           
           console.log(data);
           /*ONLINES*/
           if (data["ONLINES"] != null) 
            {
              obtainOnline(data);
            }
           
           
           /* adding posts START */ 
            if (data[0] != null) 
            {           
             var lastId = data[data.length-1]["ID"];
             var postCount = $("#bar div").length;
             var eraseLast = postCount - maxPosts;
         
             if(eraseLast>0)
             {
              var selector = "div:nth-last-child(-n+"+eraseLast+")";
              $('#bar').find(selector).remove();
             }
             
             dataToSend = { lastId: lastId };
             
              $.each(data,function(key,val) {
    
                  addToBar(val["MESSAGE"],val["NICK"]);
                
              });
          }  /* adding posts END */
          
          
          } 
          
      },"json");
     
     // lets loop it 
      setTimeout(obtain, timeout);
    }
    
   });