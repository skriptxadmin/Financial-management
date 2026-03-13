jQuery(function(){

    const form$ = jQuery("form.login");

    if(_.isEmpty(form$)){
        return;

    }
    form$.validate({

            rules : {
                username: {
                    required: true
                },
                password:{
                    required: true
                }
            },

            submitHandler:function(form, event){
                event.preventDefault();
                const data = {
                    username: form$.find("#username").val(),
                    password: form$.find("#password").val()
                }
                const options = {
                    url:"/guest/login",
                    method:"POST",
                    data:data
                }
                ajax(options);
                
            }
    })
})