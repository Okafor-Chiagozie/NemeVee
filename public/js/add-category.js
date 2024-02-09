
var add_form = document.getElementById('add-form');
var csrf_input = document.querySelector('input[name=_token]');

function capitalize(word){
   return word.charAt(0).toUpperCase() + word.slice(1);
}

function getAllTags()
{
   let request_array = {
      'method': 'GET',
      'path': `tag/create`,
      'csrf_token': '',
      'body': '',
   };
   
   let callback_success = (data) => {
      let html_content = "";

      for (const tag of data) 
         html_content += `<span>${capitalize(tag.name)} <span class="delete" onclick="deleteTag(${tag.id})">x</span></span>`;
      
      tag_section.innerHTML = html_content;
   };

   let callback_error = (data) => {
      toastr.error(data.message, 'Error Message', {timeOut: 5000});
   };

   ajax_update(request_array, callback_success, callback_error);
}

window.onload = getAllTags;

var tag_section = document.getElementById('tag-section');

add_form.addEventListener('submit', (event) => {
   event.preventDefault();

   let request_array = {
      'method': 'POST',
      'path': `tag`,
      'csrf_token': csrf_input.value,
      'body': {name: add_form.lastElementChild.firstElementChild.value.toLowerCase()},
   };

   let callback_success = (data) => {
      add_form.lastElementChild.firstElementChild.value = '';
      toastr.success(data.message, 'Success', {timeOut: 5000});
      getAllTags();
   };

   let callback_error = (data) => {
      toastr.error(data.message, 'Category Error', {timeOut: 5000});
   };

   ajax_update(request_array, callback_success, callback_error);
});


function deleteTag(tag_id)
{
   modal_box.showModal();
   html_container.style.overflowY = 'hidden';

   modal_button_yes.addEventListener('click', () => {
      let request_array = {
         'method': 'DELETE',
         'path': `tag/${tag_id}`,
         'csrf_token': csrf_input.value,
         'body': '',
      };
   
      let callback_success = (data) => {
         toastr.success(data.message, 'Success', {timeOut: 5000});
         modal_box.close();
         html_container.style.overflowY = 'auto';
         getAllTags();
      };
   
      let callback_error = (data) => {
         toastr.error(data.message, 'Tag Error', {timeOut: 5000});
      };
   
      ajax_update(request_array, callback_success, callback_error);
   });
}
