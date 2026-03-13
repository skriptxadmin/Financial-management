jQuery(function(){

    const form$ = jQuery("form.forgot-password");

    if(_.isEmpty(form$)){
        return;

    }
    form$.validate({

            rules : {
                username: {
                    required: true
                },
            },

            submitHandler:function(form, event){
                event.preventDefault();
                const data = {
                    username: form$.find("#username").val(),
                }
                const options = {
                    url:"/guest/forgot-password",
                    method:"POST",
                    data:data
                }
                ajax(options);
                
            }
    })
})