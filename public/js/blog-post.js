var csrf_input = document.querySelector('input[name=_token]');

function deletePost(nano_id)
{
   modal_box.showModal();
   html_container.style.overflowY = 'hidden';

   modal_button_yes.addEventListener('click', () => {
      let request_array = {
         'method': 'DELETE',
         'path': `post/${nano_id}`,
         'csrf_token': csrf_input.value,
         'body': '',
      };
   
      let callback_success = (data) => {
         modal_box.close();
         html_container.style.overflowY = 'auto';
         location.href = data.message;
      };
   
      let callback_error = (data) => {
         toastr.error(data.message, 'Post Error', {timeOut: 5000});
      };
   
      ajax_update(request_array, callback_success, callback_error);
   });
}

var share_icon = document.querySelectorAll('#share-icon');

share_icon.forEach((icon) => {
   if(navigator.share){
      icon.addEventListener('click', () => {
         navigator.share({
            text: document.getElementById('post-title').textContent,
            url: location.href
         }).then(() => {
            console.log('Thanks for sharing!')
         }).catch(() => {
            console.error(err);
         })
      });
   }else{
      alert('The current browser dose not support the share function, Please share manually!');
   }
});