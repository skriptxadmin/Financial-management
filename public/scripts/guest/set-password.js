jQuery(function(){

    const form$ = jQuery("form.set-password");

    if(_.isEmpty(form$)){
        return;

    }
    form$.validate({

            rules : {
                username: {
                    required: true
                },
                password: {
                    required: true,
                },
                cpassword:{
                    equalTo:"#password",
                    required: true
                }
            },

            submitHandler:function(form, event){
                event.preventDefault();
                const data = {
                    username: form$.find("#username").val(),
                    otp: form$.find("#otp").val(),
                    password: form$.find("#password").val(),
                    cpassword: form$.find("#cpassword").val(),
                }
                const options = {
                    url:"/guest/set-password",
                    method:"POST",
                    data:data
                }
                ajax(options);
                
            }
    })
})