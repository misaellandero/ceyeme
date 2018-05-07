   $(document).ready(function() {



       //desplazamiento suave de las anclas
       $('.ancla').on('click', function() {
           $('a[href*=#]').click(function() {

               if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                   location.hostname == this.hostname) {

                   var $target = $(this.hash);

                   $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');

                   if ($target.length) {

                       var targetOffset = $target.offset().top;

                       $('html,body').animate({ scrollTop: targetOffset }, 300);

                       return false;

                   }

               }

           });
       });



       //envio de mensaje y registro de cliente 
       $("#mensaje_bd").on("submit", function(event) {
           event.preventDefault();
           var datos = $(this).serialize(); 
           var enviado = ('<div class="alert alert-success">'
                +'<div class="container-fluid">'
                    +'<div class="alert-icon">'
                        +'<i class="material-icons">check</i>'
                   +' </div>'
                    +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                        +'<span aria-hidden="true"><i class="material-icons">clear</i></span>'
                    +'</button>'
                    +'<b>Todo listo:</b> Mensaje enviado correctamente.'
                +'</div>'
            +'</div>');
           $.ajax({
               type: "POST",
               url: "assets/php/enviaryguardar.php",  
               data: datos, 
               error: function(jqXHR, textStatus, errorMessage) {
                   alert(errorMessage); // Optional
               },
               success: function(data) { 

                if (data == 0) {
                    alert("Por favor verifica antes que eres humano.");
                }else{
                    alert(data);
                    $("#mensaje_bd").html(enviado);
                }
                
           }

           });

       });

       $('#enviar_mensaje').on('click', function() {



       });

   })