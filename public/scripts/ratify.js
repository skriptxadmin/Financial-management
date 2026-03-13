function ratify(html) {
  const modalEl = document.getElementById("ratifyModal");
  const contentEl = modalEl.querySelector(".modal-body");

  contentEl.innerHTML = html;

  const modal = bootstrap.Modal.getOrCreateInstance(modalEl, {
    keyboard: false,
    backdrop: "static",
  });

  modal.show();

  return new Promise((resolve, reject)=>{
    jQuery("#ratifyModal").off().on('click', 'button', function(){
        modal.hide();
        const value = jQuery(this).attr('data-value');
        if(!value){
            return resolve(false);
        }
        resolve(JSON.parse(value));
    })
  })
  
}
