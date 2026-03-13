jQuery(function(){
    const logout$ = jQuery("a.logout");
    if(!logout$?.length){
        return
    }
    logout$.on('click', async function(){
       const result = await ratify('Are you sure you want to logout?');
       if(result)
       window.location.href=logout$.attr('data-href');
    })
})