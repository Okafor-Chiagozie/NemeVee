
// ========================================
// ========= Quill Initialization =========
// ========================================
var post_body = document.getElementById('post-body');
var options = {
   debug: 'info',
   modules: {    
      toolbar: '#tools-section'
   },
   placeholder: "Tell us your story ...",
   readOnly: false,
   theme: 'snow',
};

var quill = new Quill(post_body, options);


// ========================================
// ========= Necessary Operations =========
// ========================================
var post_title = document.getElementById('post-title');
var csrf_input = document.querySelector('input[name=_token]');
var nano_id = '';
var ql_save_indicator = document.querySelector('.ql-save-indicator');
ql_save_indicator.style.color = 'green';

function populate_editor(nano){
   nano_id = nano;

   let request_array = {
      'method': 'GET',
      'path': `post/${nano}`,
      'csrf_token': csrf_input.value,
   };

   let callback_success = (data) => {
      quill.root.innerHTML = data.message.content;
   };

   let callback_error = (data) => {
      toastr.error('File not found', 'Error fetching file', {timeOut: 5000});
   };

   ajax_update(request_array, callback_success, callback_error);
}

post_title.addEventListener('keyup', () => {
   ql_save_indicator.textContent = 'Saving...';

   let request_array = {
      'method': 'PATCH',
      'path': `post/${nano_id}`,
      'csrf_token': csrf_input.value,
      'body': {title: post_title.textContent},
   };

   let callback_success = (data) => {
      // toastr.success(data.message, 'Success', {timeOut: 5000});
      ql_save_indicator.textContent = 'Saved@'+new Date().getHours()+':'+ +new Date().getMinutes()+':'+new Date().getSeconds();      
   };

   let callback_error = (data) => {
      toastr.error(data.message, 'Publish Error', {timeOut: 5000});
   };

   ajax_update(request_array, callback_success, callback_error);
});

quill.on('text-change', function(){
   ql_save_indicator.textContent = 'Saving...';

   let request_array = {
      'method': 'PATCH',
      'path': `post/${nano_id}`,
      'csrf_token': csrf_input.value,
      'body': {content: quill.root.innerHTML},
   };

   let callback_success = (data) => {
      // toastr.success(data.message, 'Success', {timeOut: 5000});
      ql_save_indicator.textContent = 'Saved@'+new Date().getHours()+':'+ +new Date().getMinutes()+':'+new Date().getSeconds();
   };

   let callback_error = (data) => {
      toastr.error(data.message, 'Publish Error', {timeOut: 5000});
   };

   ajax_update(request_array, callback_success, callback_error);
});


// ========================================
// =========== Custom Icons ===============
// ========================================
var ql_undo = document.querySelector('.ql-undo');
var ql_redo = document.querySelector('.ql-redo');
// var ql_image_custom = document.querySelector('.ql-image-custom');

ql_undo.addEventListener('click', () => {
   quill.history.undo();
});

ql_redo.addEventListener('click', () => {
   quill.history.redo();
});

// ql_image_custom.addEventListener('click', () => {
//    const range = quill.getSelection();
//    quill.insertEmbed(range ? range.index : 0, 'image', "https://images.unsplash.com/photo-1700164805522-c3f2f8885144?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwzNXx8fGVufDB8fHx8fA%3D%3D", Quill.sources.USER);
// });

window.onbeforeunload = (event) => {
   event.preventDefault();
}








